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
     * @Route("/", name="admin-dashboard")
     */
    public function dashboard2(AdministrateurRepository $AdministrateurRepository,RecruteurRepository $recruteurRepository,CandidatRepository $candidatRepository ){
        
        return $this->render('/Administrateur/Dashboard/admin-dashboard.html.twig',["administrateurs"=>$AdministrateurRepository->findAll(),"recruteurs"=>$recruteurRepository->findAll(),"candidats"=>$candidatRepository->findAll()] );
    }
}
