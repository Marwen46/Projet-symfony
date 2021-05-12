<?php

namespace App\Controller\Administrateur;

use App\Repository\CandidatRepository;
use App\Repository\RecruteurRepository;
use App\Repository\AdministrateurRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminDashboardController extends AbstractController
{
    /**
     * @Route("/", name="admin-dashboard")
     */
    public function dashboard2(AdministrateurRepository $AdministrateurRepository,RecruteurRepository $recruteurRepository,CandidatRepository $condidatRepository ){
        
        return $this->render('/Administrateur/Dashboard/admin-dashboard.html.twig',["administrateurs"=>$AdministrateurRepository->findAll(),"recruteurs"=>$recruteurRepository->findAll(),"candidats"=>$condidatRepository->findAll()] );
    }
}
