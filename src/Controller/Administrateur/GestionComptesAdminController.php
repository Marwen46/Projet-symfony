<?php

namespace App\Controller\Administrateur;

use App\Entity\User;
use App\Form\AjouterAdministrateurType;
use App\Form\ReglesType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Repository\ReglesRepository;

class GestionComptesAdminController extends AbstractController
{

    /**
     * @Route("/admin/AfficherAdministrateur{id}", name="afficher_administrateur")
     */
    public function affichierAdministrateur(UserRepository $AdministrateurRepository , $id ){

        return $this->render('/Administrateur/gestion_administrateurs/afficher_administrateur.html.twig', ['administrateur'=> $AdministrateurRepository->find($id)]);
    }
    /**
     * @Route("/admin/ajouterAdministrateur", name="ajouter_administrateur")
     */
    public function ajouter(Request $request, UserPasswordEncoderInterface $passwordEncoder )
    {   $Administrateur =new User();
        $form = $this->createForm(AjouterAdministrateurType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $Administrateur=$form->getData();
            $Administrateur->setRoles(["ROLE_ADMIN"]);
            $Administrateur->setPassword(
                $passwordEncoder->encodePassword(
                    $Administrateur,
                    $form->get('plainPassword')->getData()
                )
            );
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
    public function modifier(Request $request,UserRepository $AdministrateurRepository,$id )
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
    public function supprimer(UserRepository $AdministrateurRepository,$id )
    {   $Administrateur=$AdministrateurRepository->find($id);
        $em=$this->getDoctrine()->getManager();
        if(!$Administrateur){
            throw $this->createNotFoundException("Administrateur n'existe pas");
        }
        $em->remove($Administrateur);
        $em->flush();
        return $this->redirectToRoute("Liste-Administrateurs");
    }
    
    /**
     * @Route("/admin/regles/{id}", name="modifier_Regles")
     */
    public function modifierRegles(Request $request,ReglesRepository $ReglesRepository,$id )
    {
        $regles=$ReglesRepository->find($id);
        $form = $this->createForm(ReglesType::class,$regles);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $regles=$form->getData();
           $em= $this->getDoctrine()->getManager();
           $em->persist($regles);
           $em->flush();
           return $this->redirectToRoute("afficher-Regles");
        }
        return $this->render('Administrateur/modifierRegles.html.twig',  ['modifierRegles'=> $form->createView()]);
    }

   
}
