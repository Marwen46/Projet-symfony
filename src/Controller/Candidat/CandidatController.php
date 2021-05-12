<?php

namespace App\Controller\Candidat;

use App\Entity\Candidat;
use App\Form\CandidatType;
use App\Repository\CandidatRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CandidatController extends AbstractController
{
    /**
     * @Route("/ajouterCandidat", name="ajouter_candidat")
     */
    public function ajouter(Request $request )
    {   $Candidat =new Candidat();
        $form = $this->createForm(CandidatType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $Candidat=$form->getData();
           $em= $this->getDoctrine()->getManager();
           $em->persist($Candidat);
           $em->flush();
           return $this->redirectToRoute("admin-dashboard");
        }
        return $this->render('/Candidat/gestion_candidats/ajouter_candidat.html.twig', ['form'=> $form->createView()]);
    }
    /**
     * @Route("/supprimercandidat{id}", name="supprimer_candidat")
     */
    public function supprimer(CandidatRepository $CandidiatRepository,$id )
    {   $Candidiat=$CandidiatRepository->find($id);
        $em=$this->getDoctrine()->getManager();
        if(!$Candidiat){
            throw $this->createNotFoundException("Candidiat n'existe pas");
        }
        $em->remove($Candidiat);
        $em->flush();
        return $this->redirectToRoute("admin-dashboard");
    }

}
