<?php

namespace ademBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Utilisateur
 *
 * @ORM\Table(name="utilisateur")
 * @ORM\Entity(repositoryClass="ademBundle\Repository\UtilisateurRepository")
 * @Vich\Uploadable
 */
class Utilisateur
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    public $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=20, nullable=false)
     */
    public $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=20, nullable=false)
     */
    public $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="adressemail", type="string", length=50, nullable=false)
     */
    public $adressemail;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datedenaissance", type="date", nullable=true)
     */
    public $datedenaissance;



    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="taswira", fileNameProperty="photo")
     *
     * @var File
     */
    public $imageFile;


    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="text", length=65535, nullable=true)
     */
    public $photo;

    /**
     * @ORM\Column(type="datetime",nullable=true)
     *
     * @var \DateTime
     */
    private $photoUpdatedAt;

    /**
     * @var string
     *
     * @ORM\Column(name="motdepasse", type="string", length=20, nullable=false)
     */
    private $motdepasse;

    /**
     * @var string
     *
     * @ORM\Column(name="statut", type="string", length=20, nullable=false)
     */
    public $statut = 'actif';

    /**
     * @var integer
     *
     * @ORM\Column(name="role", type="integer", nullable=false)
     */
    public $role = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="numero", type="integer", nullable=true)
     */
    public $numero;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="ademBundle\Entity\Spectacle", mappedBy="iduser")
     */

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation", type="datetime")
     *
     * @Assert\DateTime
     *
     */
    private $dateCreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_update", type="datetime")
     *
     * @Assert\DateTime
     *
     */
    private $dateUpdate;

    public $idspectacle;

    /**
     * Utilisateur constructor.
     * @param string $nom
     * @param string $prenom
     */


    /**
     * @param File $imageFile
     */
    public function setImageFile($imageFile = null)
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

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImageName($photo)
    {
        $this->photo = $photo;
    }

    public function getImageName()
    {
        return $this->photo;
    }

    public function setImageSize($imageSize)
    {
        $this->imageSize = $imageSize;
    }

    public function getImageSize()
    {
        return $this->imageSize;
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
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     *
     * @return Annonce
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set dateUpdate
     *
     * @param \DateTime $dateUpdate
     *
     * @return Annonce
     */
    public function setDateUpdate($dateUpdate)
    {
        $this->dateUpdate = $dateUpdate;

        return $this;
    }

    /**
     * Get dateUpdate
     *
     * @return \DateTime
     */
    public function getDateUpdate()
    {
        return $this->dateUpdate;
    }







    public function __construct($nom=null, $prenom=null)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
    }

    public function __constructa()
    {
        $this->idspectacle = new \Doctrine\Common\Collections\ArrayCollection();
    }


}

