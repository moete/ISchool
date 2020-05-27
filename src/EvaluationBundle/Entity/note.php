<?php

namespace EvaluationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * note
 *
 * @ORM\Table(name="note")
 * @ORM\Entity(repositoryClass="EvaluationBundle\Repository\noteRepository")
 */
class note
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="noteds", type="float")
     */
    private $noteds;
    /**
     * @var float
     *
     * @ORM\Column(name="CC", type="float", nullable=true)
     */
    private $cC;

    /**
     * @var float
     *
     * @ORM\Column(name="noteexamen", type="float")
     */
    private $noteexamen;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="EvaluationBundle\Entity\Matiere")
     * @ORM\JoinColumn(name="id_subject",referencedColumnName="id")
     *
     * @ORM\Column(name="subject", type="string" , length=255, nullable=true)
     */
    private $subject;


    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="id_studentt",referencedColumnName="id")
     * @ORM\Column(name="student", type="string", length=255, nullable=true)
     */
    private $student;
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set noteds
     *
     * @param float $noteds
     *
     * @return note
     */
    public function setNoteds($noteds)
    {
        $this->noteds = $noteds;

        return $this;
    }

    /**
     * Get noteds
     *
     * @return float
     */
    public function getNoteds()
    {
        return $this->noteds;
    }

    /**
     * @return float
     */
    public function getCC()
    {
        return $this->cC;
    }

    /**
     * @param float $cC
     */
    public function setCC($cC)
    {
        $this->cC = $cC;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return string
     */
    public function getStudent()
    {
        return $this->student;
    }

    /**
     * @param string $student
     */
    public function setStudent($student)
    {
        $this->student = $student;
    }

    /**
     * Set noteexamen
     *
     * @param float $noteexamen
     *
     * @return note
     */
    public function setNoteexamen($noteexamen)
    {
        $this->noteexamen = $noteexamen;

        return $this;
    }

    /**
     * Get noteexamen
     *
     * @return float
     */
    public function getNoteexamen()
    {
        return $this->noteexamen;
    }
}

