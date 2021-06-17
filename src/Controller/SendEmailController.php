<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class SendEmailController extends AbstractController
{
    /**
     * @Route("/sendEmail", name="send_email")
     */
    public function index(\Swift_Mailer $mailer)
    {
     $message= (new \Swift_Message('nouveau contact'))
       ->setFrom('marouene46@gmail.com')
       ->setTo('marwen.ayoub@outlook.com')
       ->setBody(
           $this->renderView(
               'emails/emailTemplate.html.twig'
           ),
           'text/html'
       )
    ;
    return $this->render('emails/emailTemplate.html.twig');
    $mailer->send($message);
    }
}

