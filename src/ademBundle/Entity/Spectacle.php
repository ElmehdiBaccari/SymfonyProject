<?php

namespace ademBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Spectacle
 *
 * @ORM\Table(name="spectacle")
 * @ORM\Entity
 */
class Spectacle
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idSpectacle", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idspectacle;

    /**
     * @var string
     *
     * @ORM\Column(name="NomSpectacle", type="text", length=65535, nullable=false)
     */
    private $nomspectacle;

    /**
     * @var string
     *
     * @ORM\Column(name="Salle", type="string", length=30, nullable=false)
     */
    private $salle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Heurespectacle", type="time", nullable=false)
     */
    private $heurespectacle;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @var float
     *
     * @ORM\Column(name="PrixSpectacle", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixspectacle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datespec", type="date", nullable=false)
     */
    private $datespec;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="blob", nullable=false)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="image_ext", type="text", length=65535, nullable=false)
     */
    private $imageExt;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="ademBundle\Entity\Utilisateur", inversedBy="idspectacle")
     * @ORM\JoinTable(name="ratingspectacle",
     *   joinColumns={
     *     @ORM\JoinColumn(name="idspectacle", referencedColumnName="idSpectacle")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="iduser", referencedColumnName="id")
     *   }
     * )
     */
    private $iduser;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="ademBundle\Entity\Artiste", mappedBy="idspectacle")
     */
    private $idartiste;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->iduser = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idartiste = new \Doctrine\Common\Collections\ArrayCollection();
    }

}

