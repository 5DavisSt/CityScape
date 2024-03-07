<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

trait TimestampTraits
{
	#[ORM\Column (type: 'datetime_immutable', options: ['default' => 'CURRENT_TIMESTAMP'], nullable: true)]
	private \DateTimeInterface $createdAt;

	#[ORM\Column (type: 'datetime_immutable', options: ['default' => 'CURRENT_TIMESTAMP'], nullable: true)]	
	private \DateTimeInterface $updatedAt;
	
	public function getCreatedAt(): \DateTimeInterface
	{
		return $this->createdAt;
	}
	
	#[ORM\prePersist]
	public function setCreatedAt(\DateTimeImmutable $createdAt): void
	{
		$this->createdAt = new \DateTimeImmutable;
	}
		
	public function getUpdatedAt(): \DateTimeInterface
	{
		return $this->updatedAt;
	}
	
	#[ORM\preUpdate]
	public function setUpdatedAt(\DateTimeImmutable $updatedAt): void
	{
		$this->updatedAt = new \DateTimeImmutable;
	}
}