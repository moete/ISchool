<?php

namespace EvaluationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Classe
 *
 * @ORM\Table(name="Classe")
 * @ORM\Entity(repositoryClass="EvaluationBundle\Repository\ClasseRepository")
 * @UniqueEntity("nom",message="This Class is already Added")
 */
class Classe
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
     * @var int
     *
     * @ORM\Column(name="nbetudiants", type="integer")
     */
    private $nbetudiants;

    /**
     * @return int
     */
    public function getNbetudiants()
    {
        return $this->nbetudiants;
    }

    /**
     * @param int $nbetudiants
     */
    public function setNbetudiants($nbetudiants)
    {
        $this->nbetudiants = $nbetudiants;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, unique=true)
     */
    private $nom;
    /**
     * Many Groups have Many Users.
     * @ManyToMany(targetEntity="Matiere", mappedBy="classe")
     */
    private $subjects;
    public function __construct() {
        $this->subjects = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @return mixed
     */
    public function getSubjects()
    {
        return $this->subjects;
    }

    /**
     * @param mixed $subjects
     */
    public function setSubjects($subjects)
    {
        $this->subjects = $subjects;
    }



    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     *
     * @return string
     */
    public function __toString(){
        return $this->nom;
    }





}