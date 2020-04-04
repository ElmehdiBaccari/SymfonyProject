<?php

namespace ademBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Realisation
 *
 * @ORM\Table(name="realisation", indexes={@ORM\Index(name="fk_idact", columns={"idacteur"}), @ORM\Index(name="fk_idf", columns={"idfilm"})})
 * @ORM\Entity(repositoryClass="ademBundle\Repository\RealisationRepository")
 */
class Realisation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idRealisation", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idrealisation;

    /**
     * @var \ademBundle\Entity\Acteur
     *
     * @ORM\ManyToOne(targetEntity="ademBundle\Entity\Acteur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idacteur", referencedColumnName="id")
     * })
     */
    private $idacteur;

    /**
     * @var \ademBundle\Entity\Film
     *
     * @ORM\ManyToOne(targetEntity="ademBundle\Entity\Film")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idfilm", referencedColumnName="id")
     * })
     */
    private $idfilm;

    /**
     * Realisation constructor.
     * @param int $idrealisation
     * @param Acteur $idacteur
     * @param Film $idfilm
     */
    public function __construct($idrealisation = null , Acteur $idacteur = null, Film $idfilm = null)
    {
        $this->idrealisation = $idrealisation;
        $this->idacteur = $idacteur;
        $this->idfilm = $idfilm;
    }

    /**
     * @return int
     */
    public function getIdrealisation()
    {
        return $this->idrealisation;
    }

    /**
     * @param int $idrealisation
     */
    public function setIdrealisation($idrealisation)
    {
        $this->idrealisation = $idrealisation;
    }

    /**
     * @return Acteur
     */
    public function getIdacteur()
    {
        return $this->idacteur;
    }

    /**
     * @param Acteur $idacteur
     */
    public function setIdacteur($idacteur)
    {
        $this->idacteur = $idacteur;
    }

    /**
     * @return Film
     */
    public function getIdfilm()
    {
        return $this->idfilm;
    }

    /**
     * @param Film $idfilm
     */
    public function setIdfilm($idfilm)
    {
        $this->idfilm = $idfilm;
    }


}

