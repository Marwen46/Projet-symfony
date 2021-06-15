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
    public function index(MailerInterface $mailer): Response
    {
        $email = (new TemplatedEmail())
        ->from('marouene-1998@hotmail.com')
        ->to('yiyot28492@beydent.com')
        ->subject("you've been accepted for an interview !")
        ->priority(Email::PRIORITY_HIGH)
        ->htmlTemplate('email/emailTemplate.html.twig');
        $mailer->send($email);
        return $this->render('send_email/index.html.twig', [
            'controller_name' => 'SendEmailController',
        ]);
    }
}

