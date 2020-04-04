<?php

namespace ademBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Demande
 *
 * @ORM\Table(name="EvenementUser", indexes={@ORM\Index(name="idevenement", columns={"idevenement"}), @ORM\Index(name="iduser", columns={"iduser"})})
 * @ORM\Entity(repositoryClass="ademBundle\Repository\EvenementUserRepository")
 */
class EvenementUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idparticipation", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    public $idparticipation;


    /**
     * @var \ademBundle\Entity\Evenement
     *
     * @ORM\ManyToOne(targetEntity="ademBundle\Entity\Evenement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idevenement", referencedColumnName="idEvent")
     * })
     */
    public $idevenement;

    /**
     * @var \ademBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="ademBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="iduser", referencedColumnName="id")
     * })
     */
    public $iduser;

    /**
     * EvenementUser constructor.
     * @param int $idparticipation
     * @param Evenement $idevenement
     * @param User $iduser
     */
    public function __construct($idparticipation = null, Evenement $idevenement = null, User $iduser = null)
    {
        $this->idparticipation = $idparticipation;
        $this->idevenement = $idevenement;
        $this->iduser = $iduser;
    }

    /**
     * @return int
     */
    public function getIdparticipation()
    {
        return $this->idparticipation;
    }

    /**
     * @param int $idparticipation
     */
    public function setIdparticipation($idparticipation)
    {
        $this->idparticipation = $idparticipation;
    }

    /**
     * @return Evenement
     */
    public function getIdevenement()
    {
        return $this->idevenement;
    }

    /**
     * @param Evenement $idevenement
     */
    public function setIdevenement($idevenement)
    {
        $this->idevenement = $idevenement;
    }

    /**
     * @return User
     */
    public function getIduser()
    {
        return $this->iduser;
    }

    /**
     * @param User $iduser
     */
    public function setIduser($iduser)
    {
        $this->iduser = $iduser;
    }

}