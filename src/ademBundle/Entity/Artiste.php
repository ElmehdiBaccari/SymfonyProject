<?php

namespace ademBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Artiste
 *
 * @ORM\Table(name="artiste")
 * @ORM\Entity
 */
class Artiste
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idArtiste", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idartiste;

    /**
     * @var string
     *
     * @ORM\Column(name="nomArtiste", type="text", length=65535, nullable=false)
     */
    private $nomartiste;

    /**
     * @var string
     *
     * @ORM\Column(name="prenomArtiste", type="text", length=65535, nullable=false)
     */
    private $prenomartiste;

    /**
     * @var string
     *
     * @ORM\Column(name="biographieArtiste", type="text", length=65535, nullable=false)
     */
    private $biographieartiste;

    /**
     * @var string
     *
     * @ORM\Column(name="imageArtiste", type="blob", nullable=false)
     */
    private $imageartiste;

    /**
     * @var string
     *
     * @ORM\Column(name="image_extArtiste", type="text", length=65535, nullable=false)
     */
    private $imageExtartiste;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datenaissanceArtiste", type="date", nullable=false)
     */
    private $datenaissanceartiste;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="ademBundle\Entity\Spectacle", inversedBy="idartiste")
     * @ORM\JoinTable(name="spectacle_artiste",
     *   joinColumns={
     *     @ORM\JoinColumn(name="idArtiste", referencedColumnName="idArtiste")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="idSpectacle", referencedColumnName="idSpectacle")
     *   }
     * )
     */
    private $idspectacle;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idspectacle = new \Doctrine\Common\Collections\ArrayCollection();
    }

}

