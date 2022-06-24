<?php

namespace App\Entity;

use App\Repository\SubjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SubjectRepository::class)
 */
class Subject
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
    private $SubjectName;

    /**
     * @ORM\ManyToMany(targetEntity=Teacher::class, inversedBy="subjects")
     */
    private $TeachersSubjects;

    public function __construct()
    {
        $this->TeachersSubjects = new ArrayCollection();
    }
       public function __toString()
    {
        return strval($this->getSubjectName());
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubjectName(): ?string
    {
        return $this->SubjectName;
    }

    public function setSubjectName(string $SubjectName): self
    {
        $this->SubjectName = $SubjectName;

        return $this;
    }

    /**
     * @return Collection<int, Teacher>
     */
    public function getTeachersSubjects(): Collection
    {
        return $this->TeachersSubjects;
    }

    public function addTeachersSubject(Teacher $teachersSubject): self
    {
        if (!$this->TeachersSubjects->contains($teachersSubject)) {
            $this->TeachersSubjects[] = $teachersSubject;
        }

        return $this;
    }

    public function removeTeachersSubject(Teacher $teachersSubject): self
    {
        $this->TeachersSubjects->removeElement($teachersSubject);

        return $this;
    }
}
