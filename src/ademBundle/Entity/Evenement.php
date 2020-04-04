<?php

namespace ademBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Evenement
 *
 * @ORM\Table(name="evenement")
 * @ORM\Entity
 * @Vich\Uploadable
 */
class Evenement
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idEvent", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    public $idevent;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=50, nullable=false)
     */
    public $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=50, nullable=false)
     */
    public $description;

    /**
     * @var \Datetime
     * @Assert\Type(
     *      type = "\DateTime",
     *      message = "vacancy.date.valid",
     * )
     * @Assert\GreaterThanOrEqual(
     *      value = "today",
     *      message = "7ot date lyoum ya msatek"
     * )
     * @ORM\Column(name="dateDebut", type="datetime", nullable=false)
     */
    public $datedebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFin", type="datetime", nullable=false)
     */
    public $datefin;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbr_participants", type="integer", nullable=true)
     */
    public $nbrParticipants;

    /**
     * @var string
     *
     * @ORM\Column(name="typeEvent", type="string", length=20, nullable=false)
     */
    public $typeevent;

    /**
     * @var string
     *
     * @ORM\Column(name="salle", type="string", length=20, nullable=false)
     */
    public $salle;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="photoevenement", fileNameProperty="image")
     *
     * @var File
     */
    public $imageFile;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=500, nullable=true)
     */
    public $image;

    /**
     * @var integer
     *
     * @ORM\Column(name="statut", type="integer", nullable=false)
     */
    public $statut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="photo_updated_at", type="datetime", nullable=true)
     */
    public $photoUpdatedAt;

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
     * Evenement constructor.
     * @param string $nom
     * @param string $description
     * @param \DateTime $datedebut
     * @param \DateTime $datefin
     * @param int $nbrParticipants
     * @param string $typeevent
     * @param string $salle
     * @param string $image
     * @param int $statut
     */
    public function __construct($nom=null, $description=null, \DateTime $datedebut=null, \DateTime $datefin=null, $nbrParticipants=null, $typeevent=null, $salle=null, $image=null, $statut=null)
    {
        $this->nom = $nom;
        $this->description = $description;
        $this->datedebut = $datedebut;
        $this->datefin = $datefin;
        $this->nbrParticipants = $nbrParticipants;
        $this->typeevent = $typeevent;
        $this->salle = $salle;
        $this->image = $image;
        $this->statut = $statut;
    }

    /**
     * @param File $imageFile
     */
    public function setImageFile($imageFile)
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->setPhotoUpdatedAt(new \DateTime());

        }
    }

    /**
     * @return int
     */
    public function getIdevent()
    {
        return $this->idevent;
    }

    /**
     * @param int $idevent
     */
    public function setIdevent($idevent)
    {
        $this->idevent = $idevent;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return \DateTime
     */
    public function getDatedebut()
    {
        return $this->datedebut;
    }

    /**
     * @param \DateTime $datedebut
     */
    public function setDatedebut($datedebut)
    {
        $this->datedebut = $datedebut;
    }

    /**
     * @return \DateTime
     */
    public function getDatefin()
    {
        return $this->datefin;
    }

    /**
     * @param \DateTime $datefin
     */
    public function setDatefin($datefin)
    {
        $this->datefin = $datefin;
    }

    /**
     * @return int
     */
    public function getNbrParticipants()
    {
        return $this->nbrParticipants;
    }

    /**
     * @param int $nbrParticipants
     */
    public function setNbrParticipants($nbrParticipants)
    {
        $this->nbrParticipants = $nbrParticipants;
    }

    /**
     * @return string
     */
    public function getTypeevent()
    {
        return $this->typeevent;
    }

    /**
     * @param string $typeevent
     */
    public function setTypeevent($typeevent)
    {
        $this->typeevent = $typeevent;
    }

    /**
     * @return string
     */
    public function getSalle()
    {
        return $this->salle;
    }

    /**
     * @param string $salle
     */
    public function setSalle($salle)
    {
        $this->salle = $salle;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return int
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * @param int $statut
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;
    }

    /**
     * @return \DateTime
     */
    public function getPhotoUpdatedAt()
    {
        return $this->photoUpdatedAt;
    }

    /**
     * @param \DateTime $photoUpdatedAt
     */
    public function setPhotoUpdatedAt($photoUpdatedAt)
    {
        $this->photoUpdatedAt = $photoUpdatedAt;
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

