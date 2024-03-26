<?php

namespace App\MessageHandler;

use App\Entity\Newsletter\Newsletter;
use App\Entity\Newsletter\NewsletterUser;
use App\Message\SendNewsletterMessage;
use App\Service\SendNewsletterService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class SendNewsletterMessageHandler implements MessageHandlerInterface
{
    private EntityManagerInterface $entityManager;
    private SendNewsletterService $newsService;

    public function __construct(EntityManagerInterface $entityManager, SendNewsletterService $newsService)
    {
        $this->entityManager = $entityManager;
        $this->newsService = $newsService;
    }

    public function __invoke(SendNewsletterMessage $message)
    {
        // do something with your message
        $user = $this->entityManager->find(NewsletterUser::class, $message->getUserId());
        $newsletter = $this->entityManager->find(Newsletter::class, $message->getNewsId());

        // On vérifie qu'on a toutes les informations nécessaires
        if($newsletter !== null && $user !== null){
            $this->newsService->send($user, $newsletter);
        }
    }
}