<?php

namespace EvaluationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * relation
 *
 * @ORM\Table(name="relation")
 * @ORM\Entity(repositoryClass="EvaluationBundle\Repository\relationRepository")
 */
class relation
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
     * @ORM\Column(name="idparent", type="string", length=255)
     */
    private $idparent;

    /**
     * @var int
     *
     * @ORM\Column(name="idetudiant", type="integer")
     */
    private $idetudiant;


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
     * Set idparent
     *
     * @param string $idparent
     *
     * @return relation
     */
    public function setIdparent($idparent)
    {
        $this->idparent = $idparent;

        return $this;
    }

    /**
     * Get idparent
     *
     * @return string
     */
    public function getIdparent()
    {
        return $this->idparent;
    }

    /**
     * Set idetudiant
     *
     * @param integer $idetudiant
     *
     * @return relation
     */
    public function setIdetudiant($idetudiant)
    {
        $this->idetudiant = $idetudiant;

        return $this;
    }

    /**
     * Get idetudiant
     *
     * @return int
     */
    public function getIdetudiant()
    {
        return $this->idetudiant;
    }
}

