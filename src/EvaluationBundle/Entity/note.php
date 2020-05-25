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
     * @ORM\Column(name="noteexamen", type="float")
     */
    private $noteexamen;


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

