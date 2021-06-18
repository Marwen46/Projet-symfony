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
     * @Route("/candidat/ajouterCandidature/recId={rec_id}&offre={offre_id}", name="ajouter_candidature")
     */
    public function ajouter(Request $request,EntityManagerInterface $em,$rec_id ,$offre_id)
    
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
                    $Candidature->setRecruteur_id($rec_id);
                    $Candidature->setEmail($this->getuser()->getEmail());
                    $Candidature->setOffre_id($offre_id);
                    $Candidature->setNom($this->getuser()->getNom());
                    $Candidature->setPrenom($this->getuser()->getPrenom());
                    $Candidature->setTelephone($this->getuser()->getTelephone());
                    $Candidature->setAge($this->getuser()->getAge());
                    $user = $this->getUser();
                    $user->setPostulationRestant($user->getPostulationRestant()-1);
                    $em->persist($Candidature);
                    $em->persist($user);
                    $em->flush();
                    return $this->redirectToRoute("consulter_tous_les_offres");
                    
                    }
        
    }
    return $this->render('/Candidat/gestion_des_candidatures/postuler.html.twig', ['form'=> $form->createView()]);
}
}