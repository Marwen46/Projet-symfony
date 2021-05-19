<?php

namespace App\Controller\Candidat;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Form\CandidatureType;
use App\Entity\Candidat\Candidature;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CandidatureController extends AbstractController
{
    /**
     * @Route("/ajouterCandidature", name="ajouter_candidature")
     */
    public function ajouter(Request $request )
    {   $Candidature = new Candidature();
        $form = $this->createForm(CandidatureType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
                /** @var UploadedFile $uploadedFile */
                $Candidature = $form->getData();
                $em= $this->getDoctrine()->getManager();
                $em->persist($Candidature);
                $em->flush();
                $this->redirectToRoute("ajouter_candidature");
                // $uploadedFile = $form['CvFile']->getData();
                // if ($uploadedFile) {
                    // $destination = $this->getParameter('uploads_directory');
                    // $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                    // $newFilename = $originalFilename.'-'.uniqid().'.'.$uploadedFile->guessExtension();
                    // $uploadedFile->move(
                    //     $destination,
                    //     $newFilename
                    // );
                    // $Candidature->setCvFilename($newFilename);
                
                // }
                
      
        }
        return $this->render('/Candidat/gestion_des_candidatures/postuler.html.twig', ['form'=> $form->createView()]);
    
    
    }
    /**
     * @Route("/imprimer", name="pdf_list")
     */
    public function listel()
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        $candidature = $this->getDoctrine()->getRepository(Candidature::class)->findAll();



        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('Candidat/gestion_candidats/pdf.html.twig', ["candidature" => $candidature]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (inline view)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => false
        ]);


    }

}
