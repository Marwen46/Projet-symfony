<?php

namespace App\Controller\Candidat;
use App\Form\CandidatureType;
use App\Entity\Candidat\Candidature;
use Cocur\Slugify\Slugify;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Nzo\FileDownloaderBundle\FileDownloader\FileDownloader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CandidatureController extends AbstractController
{
    private $fileDownloader;

    public function __construct(FileDownloader $fileDownloader)
    {
        $this->fileDownloader = $fileDownloader;
        
        // without autowiring use: $this->get('nzo_file_downloader')
    }


    /**
     * @Route("/ajouterCandidature", name="ajouter_candidature")
     */
    public function ajouter(Request $request )
    
    {   
        $slugify = new Slugify();
        $Candidature = new Candidature();
        $form = $this->createForm(CandidatureType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
                /** @var UploadedFile $uploadedFile */
                $Candidature = $form->getData();
                $uploadedFile = $form['CvFile']->getData();
                if ($uploadedFile) {
                    $destination = $this->getParameter('uploads_directory');
                    $originalFilename = $slugify->slugify(pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME));
                    $newFilename = $originalFilename.'-'.uniqid().'.'.$uploadedFile->guessExtension();
                    $uploadedFile->move(
                        $destination,
                        $newFilename
                    );
                    $Candidature->setCvFilename($newFilename);
                
                // }
      
        }
        return $this->render('/Candidat/gestion_des_candidatures/postuler.html.twig', ['form'=> $form->createView()]);
    
        }
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
    }
    

}
