<?php

namespace App\Controller\Administrateur;

use App\Entity\Admin\Administrateur;
use App\Form\AjouterAdministrateurType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\Admin\AdministrateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GestionComptesAdminController extends AbstractController
{

    /**
     * @Route("/admin/AfficherAdministrateur{id}", name="afficher_administrateur")
     */
    public function affichierAdministrateur(AdministrateurRepository $AdministrateurRepository , $id ){

        return $this->render('/Administrateur/gestion_administrateurs/affichier_administrateur.html.twig', ['administrateur'=> $AdministrateurRepository->find($id)]);
    }
    /**
     * @Route("/admin/ajouterAdministrateur", name="ajouter_administrateur")
     */
    public function ajouter(Request $request )
    {   $Administrateur =new Administrateur();
        $form = $this->createForm(AjouterAdministrateurType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $Administrateur=$form->getData();
           $em= $this->getDoctrine()->getManager();
           $em->persist($Administrateur);
           $em->flush();
           return $this->redirectToRoute("Liste-Administrateurs");
        }
        return $this->render('/Administrateur/gestion_administrateurs/ajouter_administrateur.html.twig', ['form'=> $form->createView()]);
    }
    /**
     * @Route("/admin/modifierAdministrateur/{id}", name="modifier_administrateur")
     */
    public function modifier(Request $request,AdministrateurRepository $AdministrateurRepository,$id )
    {   $Administrateur=$AdministrateurRepository->find($id);
        $form = $this->createForm(AjouterAdministrateurType::class,$Administrateur);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $Administrateur=$form->getData();
           $em= $this->getDoctrine()->getManager();
           $em->persist($Administrateur);
           $em->flush();
           return $this->redirectToRoute("Liste-Administrateurs");
        }
        return $this->render('/Administrateur/gestion_administrateurs/modifier_administrateur.html.twig', ['form'=> $form->createView()]);
    }
    /**
     * @Route("/admin/supprimerAdministrateur/{id}", name="supprimer_administrateur")
     */
    public function supprimer(AdministrateurRepository $AdministrateurRepository,$id )
    {   $Administrateur=$AdministrateurRepository->find($id);
        $em=$this->getDoctrine()->getManager();
        if(!$Administrateur){
            throw $this->createNotFoundException("Administrateur n'existe pas");
        }
        $em->remove($Administrateur);
        $em->flush();
        return $this->redirectToRoute("Liste-Administrateurs");
    }

   
}
