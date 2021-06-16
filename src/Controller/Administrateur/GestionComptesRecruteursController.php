<?php

namespace App\Controller\Administrateur;

use App\Form\AjouterRecruteurType;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class GestionComptesRecruteursController extends AbstractController
{

    /**
     * @Route("/admin/AfficherRecruteur{id}", name="afficher_recruteur")
     */
    public function affichierRecruteur(UserRepository $UserRepository , $id ){

        return $this->render('/Administrateur/gestion_recruteurs/afficher_recruteur.html.twig', ['recruteur'=> $UserRepository->find($id)]);
    }
    /**
     * @Route("/admin/ajouterRecruteur", name="ajouter_recruteur")
     */
    public function ajouter(Request $request,  UserPasswordEncoderInterface $passwordEncoder )
    {   $Recruteur =new User();
        $form = $this->createForm(AjouterRecruteurType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $Recruteur=$form->getData();
            $Recruteur->setRoles(["ROLE_RECRUTEUR"]);
            $Recruteur->setPassword(
                $passwordEncoder->encodePassword(
                    $Recruteur,
                    $form->get('plainPassword')->getData()
                )
            );
           $em= $this->getDoctrine()->getManager();
           $em->persist($Recruteur);
           $em->flush();
           return $this->redirectToRoute("liste-Recruteurs");
        }
        return $this->render('/Administrateur/gestion_recruteurs/ajouter_recruteur.html.twig', ['form'=> $form->createView()]);
    }
    /**
     * @Route("/admin/modifierRecruteur/{id}", name="modifier_recruteur")
     */
    public function modifier(Request $request,USerRepository $userRepository,$id )
    {   $Recruteur=$userRepository->find($id);
        $form = $this->createForm(AjouterRecruteurType::class,$Recruteur);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $Recruteur=$form->getData();
           $em= $this->getDoctrine()->getManager();
           $em->persist($Recruteur);
           $em->flush();
           return $this->redirectToRoute("liste-Recruteurs");
        }
        return $this->render('/Administrateur/gestion_recruteurs/modifier_recruteur.html.twig', ['form'=> $form->createView()]);
    }
    /**
     * @Route("/admin/supprimerRecruteur/{id}", name="supprimer_recruteur")
     */
    public function supprimer(UserRepository $userRepository,$id )
    {   $Recruteur=$userRepository->find($id);
        $em=$this->getDoctrine()->getManager();
        if(!$Recruteur){
            throw $this->createNotFoundException("Recruteur n'existe pas");
        }
        $em->remove($Recruteur);
        $em->flush();
        return $this->redirectToRoute("liste-Recruteurs");
    }

   
}
