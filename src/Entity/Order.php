<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
{
    const HEAVY_LIMIT = 40000;
    const SUPER_HEAVY_LIMIT = 60000;
    const HEAVY_TAG = 'heavy';
    const FOREIGN_ORDER_TAG = 'foreignWarehouse';
    const ISSUES_TAG = 'hasIssues';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $contactEmail;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $shippingAddress;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $shippingZipcode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $shippingCountry;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $total;

    /**
     * @ORM\OneToMany(targetEntity="OrderLine", mappedBy="order")
     */
    private $lines;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $tags = [];

    /**
     * @ORM\OneToOne(targetEntity=Issues::class, cascade={"persist", "remove"})
     */
    private $issues;

    public function __construct()
    {
        $this->lines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTotal(): ?int
    {
        return $this->total;
    }

    public function setTotal(?int $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getContactEmail(): string
    {
        return $this->contactEmail;
    }

    public function setContactEmail(string $contactEmail): void
    {
        $this->contactEmail = $contactEmail;
    }

    public function getShippingAddress(): string
    {
        return $this->shippingAddress;
    }

    public function setShippingAddress(string $shippingAddress): void
    {
        $this->shippingAddress = $shippingAddress;
    }


    public function getShippingZipcode(): string
    {
        return $this->shippingZipcode;
    }

    public function setShippingZipcode(string $shippingZipcode): void
    {
        $this->shippingZipcode = $shippingZipcode;
    }

    public function getShippingCountry(): string
    {
        return $this->shippingCountry;
    }

    public function setShippingCountry(string $shippingCountry): void
    {
        $this->shippingCountry = $shippingCountry;
    }

    /**
     * @return ArrayCollection
     */
    public function getLines(): Collection
    {
        return $this->lines;
    }

    public function getTags(): ?array
    {
        return $this->tags;
    }

    public function setTags(?array $tags): self
    {
        $this->tags = $tags;

        return $this;
    }

    public function addTag(string $tag)
    {
        if(is_null($this->tags)){
            $this->tags = [];
        }

        if(!in_array($tag, $this->tags))
        {
            $this->tags[] = $tag;
        }
    }

    public function getIssues(): ?Issues
    {
        return $this->issues;
    }

    public function setIssues(?Issues $issues): self
    {
        $this->issues = $issues;

        return $this;
    }
}
