<?php

namespace App\Controller\Candidat;

use App\Entity\Candidature;
use App\Form\CandidatureType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CandidatureController extends AbstractController
{
    /**
     * @Route("/ajouterCandidat", name="ajouter_candidat")
     */
    public function ajouter(Request $request )
    {   $Candidature =new Candidature();
        $form = $this->createForm(CandidatureType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $Candidature=$form->getData();
           $em= $this->getDoctrine()->getManager();
           $em->persist($Candidature);
           $em->flush();
           return $this->redirectToRoute("admin-dashboard");
        }
        return $this->render('/Candidat/gestion_candidats/ajouter_candidat.html.twig', ['form'=> $form->createView()]);
    }


}
