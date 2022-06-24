<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StudentRepository::class)
 */
class Student
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $FIO;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $DateOfBirth;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nationality;

    /**
     * @ORM\ManyToOne(targetEntity=Group::class, inversedBy="GroupStudents")
     * @ORM\JoinColumn(nullable=false)
     */
    private $MyGroup;
        public function __toString()
        {
        return strval($this->getFIO());
        }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFIO(): ?string
    {
        return $this->FIO;
    }

    public function setFIO(string $FIO): self
    {
        $this->FIO = $FIO;

        return $this;
    }

    public function getDateOfBirth(): ?string
    {
        return $this->DateOfBirth;
    }

    public function setDateOfBirth(string $DateOfBirth): self
    {
        $this->DateOfBirth = $DateOfBirth;

        return $this;
    }

    public function getNationality(): ?string
    {
        return $this->Nationality;
    }

    public function setNationality(string $Nationality): self
    {
        $this->Nationality = $Nationality;

        return $this;
    }

    public function getMyGroup(): ?Group
    {
        return $this->MyGroup;
    }

    public function setMyGroup(?Group $MyGroup): self
    {
        $this->MyGroup = $MyGroup;

        return $this;
    }
}
