<?php

namespace ademBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Eventsponsor
 *
 * @ORM\Table(name="eventsponsor", indexes={@ORM\Index(name="idSponsors", columns={"idSponsors"}), @ORM\Index(name="idEvent", columns={"idEvent"})})
 * @ORM\Entity(repositoryClass="ademBundle\Repository\EventSponsorRepository")
 */
class Eventsponsor
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ideventsponsor", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    public $ideventsponsor;

    /**
     * @var \ademBundle\Entity\Evenement
     *
     * @ORM\ManyToOne(targetEntity="ademBundle\Entity\Evenement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idEvent", referencedColumnName="idEvent")
     * })
     */
    private $idevenement;

    /**
     * @var \ademBundle\Entity\Sponsor
     *
     * @ORM\ManyToOne(targetEntity="ademBundle\Entity\Sponsor")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idSponsors", referencedColumnName="idSponsors")
     * })
     */
    private $idSponsors;

    /**
     * Eventsponsor constructor.
     * @param int $idEvent
     * @param Evenement $idevenement
     * @param Sponsor $idSponsors
     */
    public function __construct($idEvent= null, Evenement $idevenement= null, Sponsor $idSponsors= null)
    {
        $this->idEvent = $idEvent;
        $this->idevenement = $idevenement;
        $this->idSponsors = $idSponsors;
    }

    /**
     * @return int
     */
    public function getIdEvent()
    {
        return $this->idEvent;
    }

    /**
     * @param int $idEvent
     */
    public function setIdEvent($idEvent)
    {
        $this->idEvent = $idEvent;
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
     * @return Sponsor
     */
    public function getIdSponsors()
    {
        return $this->idSponsors;
    }

    /**
     * @param Sponsor $idSponsors
     */
    public function setIdSponsors($idSponsors)
    {
        $this->idSponsors = $idSponsors;
    }


}