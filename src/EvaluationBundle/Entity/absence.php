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
     * @var string
     *
     * @ORM\Column(name="heure_deb", type="string", length=255)
     */
    private $heureDeb;

    /**
     * @var string
     *
     * @ORM\Column(name="heure_fin", type="string", length=255)
     */
    private $heureFin;

    /**
     * @var string
     *
     * @ORM\Column(name="jour", type="string", length=255)
     */
    private $jour;

    /**
     * @return string
     */
    public function getHeureDeb()
    {
        return $this->heureDeb;
    }

    /**
     * @param string $heureDeb
     */
    public function setHeureDeb($heureDeb)
    {
        $this->heureDeb = $heureDeb;
    }

    /**
     * @return string
     */
    public function getHeureFin()
    {
        return $this->heureFin;
    }

    /**
     * @param string $heureFin
     */
    public function setHeureFin($heureFin)
    {
        $this->heureFin = $heureFin;
    }

    /**
     * @return string
     */
    public function getJour()
    {
        return $this->jour;
    }

    /**
     * @param string $jour
     */
    public function setJour($jour)
    {
        $this->jour = $jour;
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
     * @return mixed
     */
    public function getClasses()
    {
        return $this->classes;
    }

    /**
     * @param mixed $classes
     */
    public function setClasses($classes)
    {
        $this->classes = $classes;
    }

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


}

