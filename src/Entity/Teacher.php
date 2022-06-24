<?php

namespace App\Entity;

use App\Repository\TeacherRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TeacherRepository::class)
 */
class Teacher
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
    private $Experience;

    /**
     * @ORM\OneToMany(targetEntity=Lesson::class, mappedBy="teacher", orphanRemoval=true)
     */
    private $TeacherLesson;

    /**
     * @ORM\ManyToMany(targetEntity=Subject::class, mappedBy="TeachersSubjects")
     */
    private $subjects;

    public function __construct()
    {
        $this->TeacherLesson = new ArrayCollection();
        $this->subjects = new ArrayCollection();
    }
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

    public function getExperience(): ?string
    {
        return $this->Experience;
    }

    public function setExperience(string $Experience): self
    {
        $this->Experience = $Experience;

        return $this;
    }

    /**
     * @return Collection<int, Lesson>
     */
    public function getTeacherLesson(): Collection
    {
        return $this->TeacherLesson;
    }

    public function addTeacherLesson(Lesson $teacherLesson): self
    {
        if (!$this->TeacherLesson->contains($teacherLesson)) {
            $this->TeacherLesson[] = $teacherLesson;
            $teacherLesson->setTeacher($this);
        }

        return $this;
    }

    public function removeTeacherLesson(Lesson $teacherLesson): self
    {
        if ($this->TeacherLesson->removeElement($teacherLesson)) {
            // set the owning side to null (unless already changed)
            if ($teacherLesson->getTeacher() === $this) {
                $teacherLesson->setTeacher(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Subject>
     */
    public function getSubjects(): Collection
    {
        return $this->subjects;
    }

    public function addSubject(Subject $subject): self
    {
        if (!$this->subjects->contains($subject)) {
            $this->subjects[] = $subject;
            $subject->addTeachersSubject($this);
        }

        return $this;
    }

    public function removeSubject(Subject $subject): self
    {
        if ($this->subjects->removeElement($subject)) {
            $subject->removeTeachersSubject($this);
        }

        return $this;
    }
}
