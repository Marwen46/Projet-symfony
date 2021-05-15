<?php

namespace App\Controller\Candidat;
use App\Entity\Candidat\Candidature;
use App\Form\CandidatureType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CandidatureController extends AbstractController
{
    /**
     * @Route("/ajouterCandidature", name="ajouter_candidature")
     */
    public function ajouter(Request $request )
    {   $Candidature = new Candidature();
        $form = $this->createForm(CandidatureType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
                /** @var UploadedFile $uploadedFile */
                $Candidature = $form->getData();
                $em= $this->getDoctrine()->getManager();
                $em->persist($Candidature);
                $em->flush();
                $this->redirectToRoute("ajouter_candidature");
                // $uploadedFile = $form['CvFile']->getData();
                // if ($uploadedFile) {
                    // $destination = $this->getParameter('uploads_directory');
                    // $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                    // $newFilename = $originalFilename.'-'.uniqid().'.'.$uploadedFile->guessExtension();
                    // $uploadedFile->move(
                    //     $destination,
                    //     $newFilename
                    // );
                    // $Candidature->setCvFilename($newFilename);
                
                // }
      
        }
        return $this->render('/Candidat/gestion_des_candidatures/postuler.html.twig', ['form'=> $form->createView()]);
    }


}
