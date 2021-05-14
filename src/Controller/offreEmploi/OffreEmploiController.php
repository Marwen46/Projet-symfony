<?php
namespace App\Controller\offreEmploi;
use App\Form\OffreEmploiType;
use App\Entity\offreEmploi\OffreEmploi;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\offreEmploi\OffreEmploiRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OffreEmploiController extends AbstractController
{
    /**
     * @Route("/offre-emploi", name="offre_emploi")
     */
    public function index(OffreEmploiRepository $offreEmploiRepository):Response
    {
        return $this->render('offre_emploi/offreEmploi.html.twig',['offres'=> $offreEmploiRepository->findAll()]);
    }
    /**
     * @Route("/offre-emploi/ajouter", name="ajouter_offre")
     */
    public function ajouterOffre(Request $request):Response
    {
            $offre = new OffreEmploi();
            $form = $this->createForm(OffreEmploiType::class,$offre);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($offre);
                $em->flush();
                return $this->redirectToRoute('offre_emploi');
            }
    
            return $this->render('offre_emploi/ajouterOffre.html.twig',['form'=> $form->createView()]);
        
    }
     /**
     * @Route("/offre-emploi/consulter/{id}",name="voir_offre");
     */
    public function voir($id): Response
    {
        $repo = $this->getDoctrine()->getRepository(OffreEmploi::class);
        $offre = $repo->find($id);
        return $this->render('offre_emploi/voirOffre.html.twig', [
            'offre' => $offre
        ]);
    }
       /**
     * @Route("/offre-emploi/modifier/{id}",name="modifier_offre");
     */
    public function modifier(int $id,Request $request): Response
    {   $repo = $this->getDoctrine()->getRepository(OffreEmploi::class);
        $offre = $repo->find($id);
        $form = $this->createForm(OffreEmploiType::class,$offre);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($offre);
            $em->flush();
            return $this->redirectToRoute('offre_emploi');
        }

        return $this->render('offre_emploi/modifierAgence.html.twig',['form'=> $form->createView()]);
    } 
     /**
     * @Route("/offre-emploi/supprimer/{id}",name="supprimer_offre");
     */
    public function supprimer(int $id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository(OffreEmploi::class);
        $offre = $rep->find($id);
        if (!$offre) {
            throw $this->createNotFoundException(
                "pas d'offre disponible"
            );
        }
        $em->remove($offre);
        $em->flush();
        return $this->redirectToRoute('offre_emploi');   
    
    }
     /**
     * @Route("/offre-emploi/consulterTous",name="consulter_tous_les_offres");
     */
    public function voirTous(OffreEmploiRepository $OffreEmploiRepository,PaginatorInterface $paginator,Request $request)
    { 
        $offres=$paginator->paginate($OffreEmploiRepository->findAll(),$request->query->getInt('page', 1),10);
        return $this->render("offre_emploi/VoirTous.html.twig",["offres"=>$offres]);
    }

         /**
     * @Route("/offre-emploi/consulterDetail/{id}",name="voir_offre_en_detail");
     */
    public function voirDetails($id): Response
    {
        $repo = $this->getDoctrine()->getRepository(OffreEmploi::class);
        $offre = $repo->find($id);
        return $this->render('offre_emploi/VoirDetail.html.twig', [
            'offre' => $offre
        ]);
    }
    
}
