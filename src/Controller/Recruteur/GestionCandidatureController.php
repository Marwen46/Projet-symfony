<?php
namespace App\Controller\Recruteur;

use App\Entity\Candidat\Candidature;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\Candidat\CandidatureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GestionCandidatureController extends AbstractController
{
    /**
     * @Route("/afficherTousCandidature", name="afficher_tousCandidature")
     */
    public function afficherTout(CandidatureRepository  $CandidatureRepository)
    {
        $Candidatures=$CandidatureRepository->findAll();
        return $this->render('Recruteur/gestion_condidature.html.twig', [
            'Candidatures' => $Candidatures,
        ]);
    }
    /**
     *@Route ("/supprimerCandidature/{id}",name="supprimer_candidature")
     */
    public function supprimerCandidature(CandidatureRepository $CandidatureRepository, EntityManagerInterface $em,$id){
        $Candidature =$CandidatureRepository->find($id);
        $em->remove($Candidature); 
        $em->flush();
        return $this->redirectToRoute("afficher_tousCandidature");
    }
    /**
     *@Route ("fixerRrendezvous/{id}",name="fixer-rendez-vous")
     */
    public function fixerRendezvous(CandidatureRepository $CandidatureRepository, EntityManagerInterface $em,$id){
        $Candidature =$CandidatureRepository->find($id);
 
    }
}
