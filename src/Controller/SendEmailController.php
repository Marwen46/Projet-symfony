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
     * @Route("/recruteur/sendEmail/id={id}&nomEntreprise={nomEntreprise}", name="send_email")
     */
    public function index(MailerInterface $mailer,AccepteesRepository $AccepteesRepository,$id,$nomEntreprise)
    {
    $acc=$AccepteesRepository->find($id);
     $message= (new TemplatedEmail())
      ->from('marwen46@gmail.com')
      ->to($acc->Email)
      ->subject('accepté pour un entretien')
      ->htmlTemplate('emails/emailTemplate.html.twig')
      ->context([
        'donner' => $acc
      ])
      ;
    $mailer->send($message);
    return $this->render('emails/emailTemplate.html.twig',['donner'=> $acc]);
    }
}

