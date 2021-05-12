<?php

namespace App\Controller\Administrateur;

use App\Entity\Recruteur;
use App\Form\AjouterRecruteurType;
use App\Repository\RecruteurRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GestionComptesRecruteursController extends AbstractController
{

    /**
     * @Route("/AffichierRecruteur{id}", name="affichier_recruteur")
     */
    public function affichierRecruteur(RecruteurRepository $recruteurRepository , $id ){

        return $this->render('/Administrateur/gestion_recruteurs/affichier_recruteur.html.twig', ['recruteur'=> $recruteurRepository->find($id)]);
    }
    /**
     * @Route("/ajouterRecruteur", name="ajouter_recruteur")
     */
    public function ajouter(Request $request )
    {   $Recruteur =new Recruteur();
        $form = $this->createForm(AjouterRecruteurType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $Recruteur=$form->getData();
           $em= $this->getDoctrine()->getManager();
           $em->persist($Recruteur);
           $em->flush();
           return $this->redirectToRoute("admin-dashboard");
        }
        return $this->render('/Administrateur/gestion_recruteurs/ajouter_recruteur.html.twig', ['form'=> $form->createView()]);
    }
    /**
     * @Route("/modifierRecruteur/{id}", name="modifier_recruteur")
     */
    public function modifier(Request $request,RecruteurRepository $recruteurRepository,$id )
    {   $Recruteur=$recruteurRepository->find($id);
        $form = $this->createForm(AjouterRecruteurType::class,$Recruteur);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $Recruteur=$form->getData();
           $em= $this->getDoctrine()->getManager();
           $em->persist($Recruteur);
           $em->flush();
           return $this->redirectToRoute("admin-dashboard");
        }
        return $this->render('/Administrateur/gestion_recruteurs/modifier_recruteur.html.twig', ['form'=> $form->createView()]);
    }
    /**
     * @Route("/supprimerRecruteur/{id}", name="supprimer_recruteur")
     */
    public function supprimer(RecruteurRepository $recruteurRepository,$id )
    {   $Recruteur=$recruteurRepository->find($id);
        $em=$this->getDoctrine()->getManager();
        if(!$Recruteur){
            throw $this->createNotFoundException("Recruteur n'existe pas");
        }
        $em->remove($Recruteur);
        $em->flush();
        return $this->redirectToRoute("admin-dashboard");
    }

   
}
