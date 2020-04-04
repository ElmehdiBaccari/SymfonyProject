<?php

namespace ademBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Demande
 *
 * @ORM\Table(name="demande", indexes={@ORM\Index(name="idsalle", columns={"idsalle"}), @ORM\Index(name="iduser", columns={"iduser"})})
 * @ORM\Entity(repositoryClass="ademBundle\Repository\DemandeRepository")
 */
class Demande
{
    /**
     * @var integer
     *
     * @ORM\Column(name="iddemande", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iddemande;

    /**
     * @var string
     *
     * @ORM\Column(name="besoin", type="text", length=65535, nullable=false)
     */
    private $besoin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datedemande", type="date", nullable=false)
     */
    private $datedemande;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=20, nullable=false)
     */
    private $etat;

    /**
     * @var \ademBundle\Entity\Salle
     *
     * @ORM\ManyToOne(targetEntity="ademBundle\Entity\Salle")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idsalle", referencedColumnName="id")
     * })
     */
    private $idsalle;

    /**
     * @var \ademBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="ademBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="iduser", referencedColumnName="id")
     * })
     */
    private $iduser;

    /**
     * Demande constructor.
     * @param int $iddemande
     * @param string $besoin
     * @param \DateTime $datedemande
     * @param string $etat
     * @param Salle $idsalle
     * @param Utilisateur $iduser
     */
    public function __construct($iddemande = null, $besoin= null, \DateTime $datedemande= null, $etat= null, Salle $idsalle= null, Utilisateur $iduser= null)
    {
        $this->iddemande = $iddemande;
        $this->besoin = $besoin;
        $this->datedemande = $datedemande;
        $this->etat = $etat;
        $this->idsalle = $idsalle;
        $this->iduser = $iduser;
    }

    /**
     * @return int
     */
    public function getIddemande()
    {
        return $this->iddemande;
    }

    /**
     * @param int $iddemande
     */
    public function setIddemande($iddemande)
    {
        $this->iddemande = $iddemande;
    }

    /**
     * @return string
     */
    public function getBesoin()
    {
        return $this->besoin;
    }

    /**
     * @param string $besoin
     */
    public function setBesoin($besoin)
    {
        $this->besoin = $besoin;
    }

    /**
     * @return \DateTime
     */
    public function getDatedemande()
    {
        return $this->datedemande;
    }

    /**
     * @param \DateTime $datedemande
     */
    public function setDatedemande($datedemande)
    {
        $this->datedemande = $datedemande;
    }

    /**
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param string $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }

    /**
     * @return Salle
     */
    public function getIdsalle()
    {
        return $this->idsalle;
    }

    /**
     * @param Salle $idsalle
     */
    public function setIdsalle($idsalle)
    {
        $this->idsalle = $idsalle;
    }

    /**
     * @return Utilisateur
     */
    public function getIduser()
    {
        return $this->iduser;
    }

    /**
     * @param Utilisateur $iduser
     */
    public function setIduser($iduser)
    {
        $this->iduser = $iduser;
    }


}

