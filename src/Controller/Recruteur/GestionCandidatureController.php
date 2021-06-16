<?php
namespace App\Controller\Recruteur;

use App\Entity\Candidat\Candidature;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\Candidat\CandidatureRepository;
use Nzo\FileDownloaderBundle\FileDownloader\FileDownloader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GestionCandidatureController extends AbstractController
{

    private $fileDownloader;

    public function __construct(FileDownloader $fileDownloader)
    {
        $this->fileDownloader = $fileDownloader;
        
    }

    /**
     * @Route("/afficherTousCandidature", name="afficher_tousCandidature")
     */
    public function afficherTout(CandidatureRepository  $CandidatureRepository)
    {
        $Candidatures=$CandidatureRepository->findAll();
        return $this->render('Recruteur/gestion_candidature.html.twig', [
            'Candidatures' => $Candidatures,
        ]);
    }

    /**
     * @Route("/telecharger_Cv/{filename}", name="telecharger_candidature_cv")
     */
    public function telecharger_cv($filename){
        return $this->fileDownloader->downloadFile("uploads/CV/$filename");
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
