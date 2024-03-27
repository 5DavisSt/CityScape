<?php

namespace App\MessageHandler;

use App\Repository\Newsletter\NewsletterRepository;
use App\Repository\Newsletter\NewsletterUserRepository;
use App\Message\SendNewsletterMessage;
use App\Service\SendNewsletterService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class SendNewsletterMessageHandler
{
    private EntityManagerInterface $entityManager;
    private SendNewsletterService $newsService;
    
    public function __construct(
        private NewsletterUserRepository $newsletterUserRepository,
        private NewsletterRepository $newsletterRepository
    ) {
    }

    public function __invoke(SendNewsletterMessage $message)
    {
        // do something with your message
        $user = $this->newsletterUserRepository->find($message->getUserId());
        $newsletter = $this->newsletterRepository->find($message->getNewsId());

        // On vérifie qu'on a toutes les informations nécessaires
        if ($newsletter !== null && $user !== null){
            $this->newsService->send($user, $newsletter);
        }
    }
}