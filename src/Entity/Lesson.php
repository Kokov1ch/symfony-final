<?php

namespace App\Entity;

use App\Repository\LessonRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LessonRepository::class)
 */
class Lesson
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
    private $StartTime;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $EndTime;

    /**
     * @ORM\ManyToOne(targetEntity=Group::class, inversedBy="lessons")
     */
    private $LessonsGroup;

    /**
     * @ORM\ManyToOne(targetEntity=Teacher::class, inversedBy="TeacherLesson")
     * @ORM\JoinColumn(nullable=false)
     */
    private $teacher;
       public function __toString(){
        return strval($this->getId());
        }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartTime(): ?string
    {
        return $this->StartTime;
    }

    public function setStartTime(string $StartTime): self
    {
        $this->StartTime = $StartTime;

        return $this;
    }

    public function getEndTime(): ?string
    {
        return $this->EndTime;
    }

    public function setEndTime(string $EndTime): self
    {
        $this->EndTime = $EndTime;

        return $this;
    }

    public function getLessonsGroup(): ?Group
    {
        return $this->LessonsGroup;
    }

    public function setLessonsGroup(?Group $LessonsGroup): self
    {
        $this->LessonsGroup = $LessonsGroup;

        return $this;
    }

    public function getTeacher(): ?Teacher
    {
        return $this->teacher;
    }

    public function setTeacher(?Teacher $teacher): self
    {
        $this->teacher = $teacher;

        return $this;
    }
}
