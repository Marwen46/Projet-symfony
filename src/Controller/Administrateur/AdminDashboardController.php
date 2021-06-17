<?php

namespace App\Controller\Administrateur;

use App\Repository\UserRepository;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ReglesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminDashboardController extends AbstractController
{
    /**
     * @Route("/listeRecruteurs", name="liste-Recruteurs")
     */
    public function recruteurs (UserRepository $userRepository){
        
        return $this->render('/Administrateur/Dashboard/ListeRecruteurs.html.twig',["recruteurs"=>$userRepository->findByRole('ROLE_RECRUTEUR')] );
    }
    /**
     * @Route("/ListeCandidats", name="Liste-Candidats")
     */
    public function candidats (UserRepository $userRepository ){
        
        return $this->render('/Administrateur/Dashboard/ListeCandidats.twig', ["candidats"=>$userRepository->findByRole('ROLE_CANDIDAT')] );
    }
    /**
     * @Route("/ListeAdministrateurs", name="Liste-Administrateurs")
     */
    public function administrateurs(UserRepository $userRepository ){
        
        return $this->render('/Administrateur/Dashboard/ListeAdministrateurs.html.twig',["administrateurs"=>$userRepository->findByRole('ROLE_ADMIN')] );
    }
    /**
     * @Route("/Regles", name="afficher-Regles")
     */
    public function Regles (ReglesRepository $reglesRepository){
        
        return $this->render('/Administrateur/Dashboard/Regles.html.twig',["regles"=>$reglesRepository->findAll()] );
    }
       /**
     * @Route("/ListeCandidatsInactifs", name="Liste-CandidatsInactifs")
     */
    public function candidatsInactifs (UserRepository $userRepository, ReglesRepository $reglesRepository ){
        
        return $this->render('/Administrateur/Dashboard/ListeCandidatsInactifs.twig', ["candidats"=>$userRepository->findByRole('ROLE_CANDIDAT'),"Regles"=>$reglesRepository->find(1)] );
    }
    
}
