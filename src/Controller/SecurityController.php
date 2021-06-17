<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Repository\UserRepository;
use App\Repository\ReglesRepository;
use Symfony\Component\Validator\Constraints\DateTime;

class SecurityController extends AbstractController
{
    /**
     * @Route("/", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils, ReglesRepository $reglesRepository): Response
    {
        if ($this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('Liste-Administrateurs');
        }
        if ($this->isGranted('ROLE_CANDIDAT')) {
            $Regles = $reglesRepository->find(1);
            $user = $this->getUser();
            $diff = date_diff(new \DateTime(), $user->getLastLogin());
            $cond = - (int) $diff->format("%R%a");
            $em= $this->getDoctrine()->getManager();
        if((int) $cond< (int) $Regles->getDuree()){
            $user->setLastLogin(new \DateTime());
            $user->setPostulationRestant($Regles->getLimitePostulation());
           $em->persist($user);
           $em->flush();
            return $this->redirectToRoute('Accueil_Candidat');
            }
            else
            {
                $em->remove($user);
                $em->flush();
                $this->logout();
                //return $this->redirectToRoute('app_register');
                
                
            }
                
        }
        if ($this->isGranted('ROLE_RECRUTEUR')) {
            return $this->redirectToRoute('offre_emploi');
        }
        if ($this->getUser()) {
            return $this->redirectToRoute('_profiler_home');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
