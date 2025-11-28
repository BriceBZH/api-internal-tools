<?php

namespace App\Entity;

use App\Repository\ToolsRepository;
use App\Controller\ToolsController;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiRange;

#[ORM\Entity(repositoryClass: ToolsRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['read:tool', 'read:category', 'read:tools']],
    operations: [
        new GetCollection(),
        new Get(
            controller: ToolsController::class,
            denormalizationContext: ['groups' => ['read:tool', 'read:category']]
        ),
        new Post(denormalizationContext: ['groups' => ['post:tool']]),
        new Put(denormalizationContext: ['groups' => ['put:tool']]),
    ]
)]
#[ApiFilter(RangeFilter::class, properties: [
    'monthlyCost',
])]
class Tools
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    
    #[Groups(['post:tool', 'read:tool'])]
    #[ApiFilter(SearchFilter::class, strategy: 'exact')]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['post:tool', 'read:tool'])]
    #[ApiFilter(SearchFilter::class, strategy: 'exact')]
    private ?string $description = null;

    #[ORM\Column(length: 100, nullable: true)]
    #[Groups(['post:tool', 'read:tool'])]
    #[ApiFilter(SearchFilter::class, strategy: 'exact')]
    private ?string $vendor = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['post:tool', 'read:tool'])]
    #[ApiFilter(SearchFilter::class, strategy: 'exact')]
    private ?string $websiteUrl = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['post:tool', 'read:tool'])]
    // #[ApiFilter(SearchFilter::class, strategy: 'exact')]
    private ?Categories $category = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    #[Groups(['post:tool', 'read:tool', 'read:tools'])]
    private ?string $monthlyCost = null;

    #[ORM\Column]
    #[Groups(['post:tool', 'read:tool'])]
    private ?int $activeUsersCount = null;

    #[ORM\Column(length: 255)]
    #[Groups(['post:tool', 'read:tool', 'read:tools'])]
    #[ApiFilter(SearchFilter::class, strategy: 'exact')]
    private ?string $ownerDepartment = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['read:tool', 'read:tools'])]
    #[ApiFilter(SearchFilter::class, strategy: 'exact')]
    private ?string $status = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['read:tool'])]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['read:tool'])]
    private ?\DateTimeImmutable $updatedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getVendor(): ?string
    {
        return $this->vendor;
    }

    public function setVendor(?string $vendor): static
    {
        $this->vendor = $vendor;

        return $this;
    }

    public function getWebsiteUrl(): ?string
    {
        return $this->websiteUrl;
    }

    public function setWebsiteUrl(?string $websiteUrl): static
    {
        $this->websiteUrl = $websiteUrl;

        return $this;
    }

    public function getCategory(): ?Categories
    {
        return $this->category;
    }

    public function setCategory(?Categories $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getMonthlyCost(): ?string
    {
        return $this->monthlyCost;
    }

    public function setMonthlyCost(string $monthlyCost): static
    {
        $this->monthlyCost = $monthlyCost;

        return $this;
    }

    public function getActiveUsersCount(): ?int
    {
        return $this->activeUsersCount;
    }

    public function setActiveUsersCount(int $activeUsersCount): static
    {
        $this->activeUsersCount = $activeUsersCount;

        return $this;
    }

    public function getOwnerDepartment(): ?string
    {
        return $this->ownerDepartment;
    }

    public function setOwnerDepartment(string $ownerDepartment): static
    {
        $this->ownerDepartment = $ownerDepartment;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): static
    {
        $this->status = $status;

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

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    
}
