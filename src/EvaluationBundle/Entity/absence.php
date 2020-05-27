<?php

namespace EvaluationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

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
     * @var string
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="id_studentt",referencedColumnName="id")
     * @ORM\Column(name="student", type="string", length=255, nullable=true)
     */
    private $student;

    /**
     * Many Users have Many Groups.
     * @ManyToMany(targetEntity="Classe",inversedBy="Matiere")
     * @JoinTable(name="abscence_byClasse",
     *      joinColumns={@JoinColumn(name="abscence_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="class_id", referencedColumnName="id")}
     *      )
     */

    private $classes;
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

