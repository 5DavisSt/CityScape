<?php

namespace App\Service;

use App\Entity\Newsletter\Newsletter;
use App\Entity\Newsletter\NewsletterUser;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class SendNewsletterService
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function send(NewsletterUser $user, Newsletter $newsletter): void
    {
        sleep(5);
        //throw new \Exception('Message non envoyé');
        $email = (new TemplatedEmail())
            ->from('newsletter@cityscape.com')
            ->to($user->getNewsUserEmail())
            ->subject($newsletter->getNewsTitle())
            ->htmlTemplate('emails/newsletter.html.twig')
            ->context(compact('newsletter', 'user'))
        ;
        
        $this->mailer->send($email);
    }
}