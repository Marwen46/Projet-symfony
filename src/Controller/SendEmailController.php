<?php

namespace App\Controller;

use Symfony\Component\Mime\Email;
use App\Entity\offreEmploi\OffreEmploi;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SendEmailController extends AbstractController
{
    
    /**
     * @Route("/recruteur/sendEmail", name="send_email")
     */
    public function index(MailerInterface $mailer)
    {
       
     $message= (new TemplatedEmail())
      ->from('marwen46@gmail.com')
      ->to('marwen.ayoub@outlook.com')
      ->subject('accepté pour un entretien')
      ->htmlTemplate('emails/emailTemplate.html.twig');
    $mailer->send($message);
    return $this->render('emails/emailTemplate.html.twig');
    }
}

