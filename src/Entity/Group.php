<?php

namespace App\Entity;

use App\Repository\GroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GroupRepository::class)
 * @ORM\Table(name="`group`")
 */
class Group
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
    private $KnowledgeLevel;

    /**
     * @ORM\OneToMany(targetEntity=Student::class, mappedBy="MyGroup", orphanRemoval=true)
     */
    private $GroupStudents;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Lesson;

    /**
     * @ORM\OneToMany(targetEntity=Lesson::class, mappedBy="LessonsGroup")
     */
    private $lessons;
    public function __construct()
    {
        $this->GroupStudents = new ArrayCollection();
        $this->lessons = new ArrayCollection();
    }
       public function __toString(){
        return strval($this->getId());
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKnowledgeLevel(): ?string
    {
        return $this->KnowledgeLevel;
    }

    public function setKnowledgeLevel(string $KnowledgeLevel): self
    {
        $this->KnowledgeLevel = $KnowledgeLevel;

        return $this;
    }

    /**
     * @return Collection<int, Student>
     */
    public function getGroupStudents(): Collection
    {
        return $this->GroupStudents;
    }

    public function addGroupStudent(Student $groupStudent): self
    {
        if (!$this->GroupStudents->contains($groupStudent)) {
            $this->GroupStudents[] = $groupStudent;
            $groupStudent->setMyGroup($this);
        }

        return $this;
    }

    public function removeGroupStudent(Student $groupStudent): self
    {
        if ($this->GroupStudents->removeElement($groupStudent)) {
            // set the owning side to null (unless already changed)
            if ($groupStudent->getMyGroup() === $this) {
                $groupStudent->setMyGroup(null);
            }
        }

        return $this;
    }

    public function getLesson(): ?string
    {
        return $this->Lesson;
    }

    public function setLesson(string $Lesson): self
    {
        $this->Lesson = $Lesson;

        return $this;
    }

    /**
     * @return Collection<int, Lesson>
     */
    public function getLessons(): Collection
    {
        return $this->lessons;
    }

    public function addLesson(Lesson $lesson): self
    {
        if (!$this->lessons->contains($lesson)) {
            $this->lessons[] = $lesson;
            $lesson->setLessonsGroup($this);
        }

        return $this;
    }

    public function removeLesson(Lesson $lesson): self
    {
        if ($this->lessons->removeElement($lesson)) {
            // set the owning side to null (unless already changed)
            if ($lesson->getLessonsGroup() === $this) {
                $lesson->setLessonsGroup(null);
            }
        }

        return $this;
    }
}
