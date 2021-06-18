<?php

namespace App\Controller\Categorie;

use App\Form\CategorieFormType;
use App\Entity\Categorie\Categorie;
use App\Repository\Categorie\CategorieRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
class CategorieController extends AbstractController
{
    /**
     * @Route("/recruteur/categorie", name="categorie")
     */
    public function index(CategorieRepository $categorieRepository): Response
    {   
        return $this->render('Categorie/index.html.twig', [
            'categories' => $categorieRepository->findAll()
        ]);
    }
     /**
     * @Route("/recruteur/categorie/ajouter", name="ajouter_categorie")
     */
    public function ajouter(Request $request ): Response
    {   $categorie =new Categorie();
        $form = $this->createForm(CategorieFormType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $categorie=$form->getData();
           $em= $this->getDoctrine()->getManager();
           $em->persist($categorie);
           $em->flush();
           return $this->redirectToRoute("categorie");
        }
        return $this->render('/Categorie/ajouterCategorie.html.twig', ['form'=> $form->createView()]);
    }

     /**
     * @Route("/recruteur/Categorie/consulter/{id}",name="voirCategorie");
     */
    public function voir($id): Response
    {
        $repo = $this->getDoctrine()->getRepository(Categorie::class);
        $categorie = $repo->find($id);
        return $this->render('Categorie/voirCategorie.html.twig', [
            'categorie' => $categorie,
        ]);
    }
   

    /**
    * @Route("/recruteur/categorie/modifier/{id}",name="modifierCategorie");
    */
    public function modifier(int $id,Request $request): Response
    {   $repo = $this->getDoctrine()->getRepository(Categorie::class);
        $categorie = $repo->find($id);
        $form = $this->createForm(CategorieFormType::class,$categorie);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();
            return $this->redirectToRoute('categorie');
        }

        return $this->render('/Categorie/modifierCategorie.html.twig',['form'=> $form->createView()]);
    } 
        /**
     * @Route("/recruteur/categorie/supprimer/{id}",name="supprimerCategorie");
     */
    public function supprimer(int $id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository(Categorie::class);
        $categorie = $rep->find($id);
        if (!$categorie) {
            throw $this->createNotFoundException(
                'pas de categourie trouver'
            );
        }
        $em->remove($categorie);
        $em->flush();
        return $this->redirectToRoute('categorie');   
    
    }

    
}
