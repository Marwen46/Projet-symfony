<?php
namespace App\Controller\Recruteur;

use App\Entity\Acceptees;
use App\Form\AccepteesType;
use App\Entity\Candidat\Candidature;
use App\Repository\AccepteesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\Candidat\CandidatureRepository;
use App\Repository\offreEmploi\OffreEmploiRepository;
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
     * @Route("/recruteur/afficherTousCandidature", name="afficher_tousCandidature")
     */
    public function afficherTout(CandidatureRepository  $CandidatureRepository ,OffreEmploiRepository $OffreEmploiRepository)
    {   
        $Offre=$OffreEmploiRepository->findBy(["RecruteurId"=>$this->getuser()->getId()]);
        $Candidatures=$CandidatureRepository->findBy(["Recruteur_id"=>$this->getuser()->getId()]);
        return $this->render('Recruteur/gestion_candidature.html.twig', [
            'Candidatures' => $Candidatures,"Offre"=> $Offre
        ]);
    }

    /**
     * @Route("/recruteur/telecharger_Cv/{filename}", name="telecharger_candidature_cv")
     */
    public function telecharger_cv($filename){
        return $this->fileDownloader->downloadFile("uploads/CV/$filename");
    }
    /**
     *@Route ("/recruteur/supprimerCandidature/{id}",name="supprimer_candidature")
     */
    public function supprimerCandidature(CandidatureRepository $CandidatureRepository, EntityManagerInterface $em,$id){
        $Candidature =$CandidatureRepository->find($id);
        $em->remove($Candidature); 
        $em->flush();
        return $this->redirectToRoute("afficher_tousCandidature");
    }
    /**
     *@Route ("/recruteurfixerRrendezvous/Prenom={Prenom}&Nom={Nom}&Email={Email}&Offre={Offre}",name="fixer-rendez-vous")
     */
    public function fixerRendezvous(Request $request,AccepteesRepository $AccepteesRepository,EntityManagerInterface $em,$Prenom,$Nom,$Email,$Offre){
        $Acceptees=new Acceptees();
        $form = $this->createForm(AccepteesType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $Acceptees=$form->getData();
            $Acceptees=$Acceptees->setPrenom($Prenom);
            $Acceptees=$Acceptees->setNom($Nom);
            $Acceptees=$Acceptees->setEmail($Email);
            $Acceptees=$Acceptees->setOffre($Offre);
        $em->persist($Acceptees);
        $em->flush();
        $res=$AccepteesRepository->findLastInserted();
        $nomEntreprise=$this->getUser()->nom;
        return $this->redirectToRoute('send_email',["id"=>$res,"nomEntreprise"=>$nomEntreprise]);
        }
        return $this->render("Recruteur/Acceptees.html.twig",[ 'form' =>$form->createView()]);
    }
}
