<?php

namespace App\Entity;

use App\Repository\UsageLogsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsageLogsRepository::class)]
class UsageLogs
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $user = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Tools $tool = null;

    #[ORM\Column]
    private ?\DateTime $sessionDate = null;

    #[ORM\Column(nullable: true)]
    private ?int $usageMinutes = null;

    #[ORM\Column(nullable: true)]
    private ?int $actionsCount = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $createdAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?Users
    {
        return $this->user_id;
    }

    public function setUserId(?Users $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getTool(): ?Tools
    {
        return $this->tool;
    }

    public function setTool(?Tools $tool): static
    {
        $this->tool = $tool;

        return $this;
    }

    public function getSessionDate(): ?\DateTime
    {
        return $this->sessionDate;
    }

    public function setSessionDate(\DateTime $sessionDate): static
    {
        $this->sessionDate = $sessionDate;

        return $this;
    }

    public function getUsageMinutes(): ?int
    {
        return $this->usageMinutes;
    }

    public function setUsageMinutes(?int $usageMinutes): static
    {
        $this->usageMinutes = $usageMinutes;

        return $this;
    }

    public function getActionsCount(): ?int
    {
        return $this->actionsCount;
    }

    public function setActionsCount(?int $actionsCount): static
    {
        $this->actionsCount = $actionsCount;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
