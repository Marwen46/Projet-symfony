<?php

namespace App\Controller;

use Symfony\Component\Mime\Email;
use App\Entity\offreEmploi\OffreEmploi;
use App\Repository\AccepteesRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SendEmailController extends AbstractController
{
    
    /**
     * @Route("/recruteur/sendEmail/", name="send_email")
     */
    public function index(MailerInterface $mailer,AccepteesRepository $AccepteesRepository)
    {
      $lastmail=$AccepteesRepository->findLastInserted();
   // $acc=$AccepteesRepository->find($id);
    $user= $this->getUser();
    // dd($user);
     $email = $user->getEmail();
     $message= (new TemplatedEmail())
      ->from($email)
      ->to($lastmail->getEmail())
      ->subject('accepté pour un entretien')
      ->htmlTemplate('emails/emailTemplate.html.twig')
      ->context([
        'donner' => $lastmail
      ])
      ;
    $mailer->send($message);
    return $this->render('emails/emailTemplate.html.twig',['donner'=> $lastmail ]);
    }
}

