<?php

namespace App\Controller\Administrateur;

use App\Repository\Candidat\CandidatRepository;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\Recruteur\RecruteurRepository;
use App\Repository\Admin\AdministrateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminDashboardController extends AbstractController
{
    /**
     * @Route("/listeRecruteurs", name="liste-Recruteurs")
     */
    public function recruteurs (RecruteurRepository $recruteurRepository){
        
        return $this->render('/Administrateur/Dashboard/ListeRecruteurs.html.twig',["recruteurs"=>$recruteurRepository->findAll()] );
    }
    /**
     * @Route("/ListeCandidats", name="Liste-Candidats")
     */
    public function candidats (CandidatRepository $candidatRepository ){
        
        return $this->render('/Administrateur/Dashboard/ListeCandidats.twig',["candidats"=>$candidatRepository->findAll()] );
    }
    /**
     * @Route("/ListeAdministrateurs", name="Liste-Administrateurs")
     */
    public function administrateurs(AdministrateurRepository $AdministrateurRepository ){
        
        return $this->render('/Administrateur/Dashboard/ListeAdministrateurs.html.twig',["administrateurs"=>$AdministrateurRepository->findAll()] );
    }
}
