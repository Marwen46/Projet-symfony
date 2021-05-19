<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Entity\Candidat\Candidat;
use App\Form\CandidatRegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            
            );
            $user->setUsername($form->get('username')->getData());
            $user->setRoles(["ROLE_CANDIDAT"]);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('candidat_registration');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
    /**
     * @Route("/register/A_Little_More_About_You", name="candidat_registration")
     */
    public function addmore(Request $request): Response
    {
        $candidat = new Candidat();
        $form = $this->createForm(CandidatRegistrationType::class, $candidat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $candidat->setNom($form->get('Nom')->getData());
            $candidat->setPrenom($form->get('Prenom')->getData());
            $candidat->setAge($form->get('Age')->getData());
            $candidat->setEmail($form->get('Email')->getData());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($candidat);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_login');
        }
        return $this->render('candidat_registration/index.html.twig', [
            'CandidatRegistrationForm' => $form->createView(),
        ]);
    }
}
