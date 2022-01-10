<?php

namespace App\Entity;

use App\Repository\IssuesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IssuesRepository::class)
 */
class Issues
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $superHeavyProblem;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $invalidAddressProblem;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $emailProblem;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isSuperHeavyProblem(): ?bool
    {
        return $this->superHeavyProblem;
    }

    public function setSuperHeavyProblem(): self
    {
        $this->superHeavyProblem = true;

        return $this;
    }

    public function isInvalidAddressProblem(): ?bool
    {
        return $this->invalidAddressProblem;
    }

    public function setInvalidAddressProblem(): self
    {
        $this->invalidAddressProblem = true;

        return $this;
    }

    public function isEmailProblem(): ?bool
    {
        return $this->emailProblem;
    }

    public function setEmailProblem(): self
    {
        $this->emailProblem = true;

        return $this;
    }
}
