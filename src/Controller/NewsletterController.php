<?php

namespace App\Controller;

use App\Entity\Newsletter\Newsletter;
use App\Entity\Newsletter\NewsletterUser;
use App\Form\NewsletterFormType;
use App\Form\NewsletterUserFormType;
use App\Message\SendNewsletterMessage;
use App\Repository\Newsletter\NewsletterRepository;
use App\Service\SendNewsletterService;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Mailer\MailerInterface;
//use Symfony\Component\Mailer\Messenger;
use Symfony\Component\Messenger\MessageBusInterface;

class NewsletterController extends AbstractController
{
    #[Route('/newsletter', name: 'app_newsletter')]
    public function index(EntityManagerInterface $entityManager, Request $request, MailerInterface $mailer): Response
    {
        $user = new NewsletterUser();
        $form = $this->createForm(NewsletterUserFormType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $token = hash('sha256', uniqid());

            $user->setNewsUserValidationToken($token);

            $entityManager->persist($user);
            $entityManager->flush();

            $email = (new TemplatedEmail())
                ->from('newsletter@cityscape.com')
                ->to($user->getNewsUserEmail())
                ->subject('Your subscription to our newsletter')
                ->htmlTemplate('emails/inscription_newsletter.html.twig')
                ->context(compact('user', 'token'))
                ;

            $mailer->send($email);

            $this->addFlash('message', 'Inscription en attente de validation');
            
            return $this->redirectToRoute('app_home');
        }

        return $this->render('newsletter/newsletter.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/confirm/{id}/{token}', name: 'app_confirm_newsletter')]
    public function confirm(EntityManagerInterface $entityManager, NewsletterUser $user, $token): Response
    {
        if ($user->getNewsUserValidationToken() != $token) {
            throw $this->createNotFoundException('Page non trouvée');
        }

        $user->setIsValid(true);

        $entityManager->persist($user);
        $entityManager->flush();

        $this->addFlash('message', 'Compte activé');

        return $this->redirectToRoute('app_home');
    }

    #[Route('/prepare', name: 'app_prepare_newsletter')]
    public function prepare(EntityManagerInterface $entityManager, Request $request): Response
    {
        $newsletter = new Newsletter();
        $form = $this->createForm(NewsletterFormType::class, $newsletter);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($newsletter);
            $entityManager->flush();

            return $this->redirectToRoute('app_list_newsletter');
        }

        return $this->render('newsletter/prepare_newsletter.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/list', name: 'app_list_newsletter')]
    public function list(NewsletterRepository $newsletter): Response
    {
        return $this->render('newsletter/list_newsletter.html.twig', [
            'newsletters' => $newsletter->findAll()
        ]);
    }

    #[Route('/send/{id}', name: 'app_send_newsletter')]
    public function send(NewsletterUser $user, Newsletter $newsletter, MessageBusInterface $messageBus): Response
    {
        foreach ($user as $users) {
            if ($users->isValid()) {
                $messageBus->dispatch(new SendNewsletterMessage($users->getId(), $newsletter->getId()));
            } else {
                throw $this->createNotFoundException('Message non envoyé');
            }
        }

        // $newsletter->setIsSent(true);

        // $em = $this->getDoctrine()->getManager();
        // $em->persist($newsletter);
        // $em->flush();

        return $this->redirectToRoute('app_list_newsletter');
    }

    #[Route('/unsubscribe/{id}/{newsletter}/{token}', name: 'app_unsuscribe_newsletter')]
    public function unsubscribe(EntityManagerInterface $entityManager, NewsletterUser $user, Newsletter $newsletter, $token): Response
    {
        if ($user->getNewsUserValidationToken() != $token) {
            throw $this->createNotFoundException('Page non trouvée');
        }

        //if (count($user->getCategories()) > 1) {
            //$user->removeCategory($newsletter->getCategories());
            //$entityManager->persist($user);
        //} else {
            //$em->remove($user);
        //}
        
        $entityManager->persist($user);
        
        $entityManager->flush();

        $this->addFlash('message', 'Newsletter supprimée');

        return $this->redirectToRoute('app_home');
    }
}