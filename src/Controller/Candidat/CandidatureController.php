<?php

namespace App\Controller\Candidat;
use App\Form\CandidatureType;
use App\Entity\Candidat\Candidature;
use Cocur\Slugify\Slugify;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Id;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Nzo\FileDownloaderBundle\FileDownloader\FileDownloader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mime\Email;

class CandidatureController extends AbstractController
{

    /**
     * @Route("/ajouterCandidature", name="ajouter_candidature")
     */
    public function ajouter(Request $request,EntityManagerInterface $em )
    
    {   
        $slugify = new Slugify();
        $Candidature = new Candidature();
        $form = $this->createForm(CandidatureType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
                /** @var UploadedFile $uploadedFile */
                $Candidature = $form->getData();
                $uploadedFile = $form['CvFile']->getData();
                if ($uploadedFile) {
                    $destination = $this->getParameter('uploads_directory');
                    $originalFilename = $slugify->slugify(pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME));
                    $newFilename = $originalFilename.'-'.uniqid().'.'.$uploadedFile->guessExtension();
                    $uploadedFile->move(
                        $destination,
                        $newFilename
                    );
                    $Candidature->setCvFilename($newFilename);
                    $Candidature->setCandidatId($this->getuser()->getId());
                    $Candidature->setNom($this->getuser()->getNom());
                    $Candidature->setPrenom($this->getuser()->getPrenom());
                    $Candidature->setTelephone($this->getuser()->getTelephone());
                    $Candidature->setAge($this->getuser()->getAge());
                    $em->persist($Candidature);
                    $em->flush();
                    return $this->redirectToRoute("ajouter_candidature");
                    
                    }
        
    }
    return $this->render('/Candidat/gestion_des_candidatures/postuler.html.twig', ['form'=> $form->createView()]);
}
}