<?php

namespace ademBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EmpruntLivre
 *
 * @ORM\Table(name="emprunt_livre", indexes={@ORM\Index(name="fk", columns={"id_livre"}), @ORM\Index(name="fk1", columns={"id_user"})})
 * @ORM\Entity(repositoryClass="ademBundle\Repository\EmpruntRepository")
 */
class EmpruntLivre
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_emprunt", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    public $id_emprunt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="d_emprunt", type="date", nullable=false)
     */
    public $d_emprunt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="d_retour", type="date", nullable=false)
     */
    public $d_retour;

    /**
     * @var \ademBundle\Entity\Livre
     *
     * @ORM\ManyToOne(targetEntity="ademBundle\Entity\Livre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_livre", referencedColumnName="id_livre")
     * })
     */
    public $id_livre;

    /**
     * @var \ademBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="ademBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     * })
     */
    public $id_user;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation", type="datetime", nullable=true)
     */
    public $dateCreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_update", type="datetime", nullable=true)
     */
    public $dateUpdate;

    /**
     * EmpruntLivre constructor.
     * @param int $id_emprunt
     * @param \DateTime $d_emprunt
     * @param \DateTime $d_retour
     * @param Livre $id_livre
     * @param User $id_user
     * @param \DateTime $dateCreation
     * @param \DateTime $dateUpdate
     */
    public function __construct($id_emprunt=null, \DateTime $d_emprunt=null, \DateTime $d_retour=null, Livre $id_livre=null, User $id_user=null, \DateTime $dateCreation=null, \DateTime $dateUpdate=null)
    {
        $this->id_emprunt = $id_emprunt;
        $this->d_emprunt = $d_emprunt;
        $this->d_retour = $d_retour;
        $this->id_livre = $id_livre;
        $this->id_user = $id_user;
        $this->dateCreation = $dateCreation;
        $this->dateUpdate = $dateUpdate;
    }

    /**
     * @return int
     */
    public function getIdEmprunt()
    {
        return $this->id_emprunt;
    }

    /**
     * @param int $id_emprunt
     */
    public function setIdEmprunt($id_emprunt)
    {
        $this->id_emprunt = $id_emprunt;
    }

    /**
     * @return \DateTime
     */
    public function getDEmprunt()
    {
        return $this->d_emprunt;
    }

    /**
     * @param \DateTime $d_emprunt
     */
    public function setDEmprunt($d_emprunt)
    {
        $this->d_emprunt = $d_emprunt;
    }

    /**
     * @return \DateTime
     */
    public function getDRetour()
    {
        return $this->d_retour;
    }

    /**
     * @param \DateTime $d_retour
     */
    public function setDRetour($d_retour)
    {
        $this->d_retour = $d_retour;
    }

    /**
     * @return Livre
     */
    public function getIdLivre()
    {
        return $this->id_livre;
    }

    /**
     * @param Livre $id_livre
     */
    public function setIdLivre($id_livre)
    {
        $this->id_livre = $id_livre;
    }

    /**
     * @return User
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * @param User $id_user
     */
    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;
    }



    /**
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * @param \DateTime $dateCreation
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
    }

    /**
     * @return \DateTime
     */
    public function getDateUpdate()
    {
        return $this->dateUpdate;
    }

    /**
     * @param \DateTime $dateUpdate
     */
    public function setDateUpdate($dateUpdate)
    {
        $this->dateUpdate = $dateUpdate;
    }



}

