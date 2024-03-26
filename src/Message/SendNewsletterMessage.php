<?php

namespace App\Message;

class SendNewsletterMessage
{
    public function __construct(private int $userId, private int $newsId)
    {
        
    }

    public function getUserId(): int
    {
        return $this->userId;
    }
    public function getNewsId(): int
    {
        return $this->newsId;
    }
}