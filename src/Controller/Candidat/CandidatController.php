<?php

namespace App\Controller\Candidat;

use App\Form\CandidatType;
use App\Form\CandidatRegistrationType;
use App\Form\RegistrationFormType;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\UserRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CandidatController extends AbstractController
{
    /**
     * @Route("/admin/ajouterCandidat", name="ajouter_candidat")
     */
    public function ajouter(Request $request, UserPasswordEncoderInterface $passwordEncoder )
    {   $Candidat =new User();
        $form = $this->createForm(CandidatType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $Candidat=$form->getData();
            $Candidat->setPassword(
                $passwordEncoder->encodePassword(
                    $Candidat,
                    $form->get('plainPassword')->getData()
                )
            );
            $Candidat->setRoles(["ROLE_CANDIDAT"]);
           $em= $this->getDoctrine()->getManager();
           $em->persist($Candidat);
           $em->flush();
           return $this->redirectToRoute("Liste-Candidats");
        }
        return $this->render('Candidat/gestion_candidats/ajouter_candidat.html.twig', ['form'=> $form->createView()]);
    }
     /**
     * @Route("/candidat/Home", name="Accueil_Candidat")
     */
    public function Home()
    {  
        $user = $this->getUser();
        return $this->render('Candidat/Accueil/Accueil.html.twig',['id' => $user->getId()]);
    }
    /**
     * @Route("/admin/supprimercandidat{id}", name="supprimer_candidat")
     */
    public function supprimer(UserRepository $CandidiatRepository,$id )
    {   $Candidiat=$CandidiatRepository->find($id);
        $em=$this->getDoctrine()->getManager();
        if(!$Candidiat){
            throw $this->createNotFoundException("Candidiat n'existe pas");
        }
        $em->remove($Candidiat);
        $em->flush();
        return $this->redirectToRoute("Liste-Candidats");
    }
    /**
     * @Route("/candidat/modifier_candidat/{id}", name="modifier_candidat")
     */
    public function modifier(Request $request,UserRepository $UserRepository,$id )
    {   //$id = $this->getId;
        $user=$UserRepository->find($id);
        $form = $this->createForm(RegistrationFormType::class,$user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $user=$form->getData();
           $em= $this->getDoctrine()->getManager();
           $em->persist($user);
           $em->flush();
           return $this->redirectToRoute("Accueil_Candidat");
        }
        return $this->render('Candidat/modifyProfile.html.twig',  ['modifyProfileForm'=> $form->createView()]);
    }
    /**
     * @Route("/admin/modifier_candidat/{id}", name="modifier_candidatpadmin")
     */
    public function admodifier(Request $request,UserRepository $UserRepository,$id )
    {   //$id = $this->getId;
        $user=$UserRepository->find($id);
        $form = $this->createForm(RegistrationFormType::class,$user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $user=$form->getData();
           $em= $this->getDoctrine()->getManager();
           $em->persist($user);
           $em->flush();
           return $this->redirectToRoute("Liste-Candidats");
        }
        return $this->render('Candidat/modifyProfile.html.twig',  ['modifyProfileForm'=> $form->createView()]);
    }

}
