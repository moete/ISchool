<?php

namespace EvaluationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * absence
 *
 * @ORM\Table(name="absence")
 * @ORM\Entity(repositoryClass="EvaluationBundle\Repository\absenceRepository")
 */
class absence
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
     * @var \DateTime
     *
     * @ORM\Column(name="dateabsence", type="datetime")
     */
    private $dateabsence;


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
     * Set dateabsence
     *
     * @param \DateTime $dateabsence
     *
     * @return absence
     */
    public function setDateabsence($dateabsence)
    {
        $this->dateabsence = $dateabsence;

        return $this;
    }

    /**
     * Get dateabsence
     *
     * @return \DateTime
     */
    public function getDateabsence()
    {
        return $this->dateabsence;
    }
}

