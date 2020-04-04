<?php

namespace ademBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Collection
 *
 * @ORM\Table(name="collection")
 * @ORM\Entity
 * @Vich\Uploadable
 */
class Collection
{
    /**
     * @var integer
     *
     * @ORM\Column(name="num_collection", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    public $num_collection;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_collection", type="string", length=50, nullable=false)
     */
    public $nomCollection;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_collection", type="date", nullable=false)
     */
    public $dateCollection;


    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="photocollection", fileNameProperty="image")
     *
     * @var File
     */
    public $imageFile;



    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=50, nullable=false)
     */
    public $image;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=2000, nullable=false)
     */
    public $description;

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
     * Collection constructor.
     * @param int $numCollection
     * @param string $nomCollection
     * @param \DateTime $dateCollection
     * @param string $image
     * @param string $description
     */
    public function __construct($numCollection=null, $nomCollection=null, \DateTime $dateCollection=null, $image=null, $description=null)
    {
        $this->numCollection = $numCollection;
        $this->nomCollection = $nomCollection;
        $this->dateCollection = $dateCollection;
        $this->image = $image;
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getNumCollection()
    {
        return $this->numCollection;
    }

    /**
     * @param int $numCollection
     */
    public function setNumCollection($numCollection)
    {
        $this->numCollection = $numCollection;
    }

    /**
     * @return string
     */
    public function getNomCollection()
    {
        return $this->nomCollection;
    }

    /**
     * @param string $nomCollection
     */
    public function setNomCollection($nomCollection)
    {
        $this->nomCollection = $nomCollection;
    }

    /**
     * @return \DateTime
     */
    public function getDateCollection()
    {
        return $this->dateCollection;
    }

    /**
     * @param \DateTime $dateCollection
     */
    public function setDateCollection($dateCollection)
    {
        $this->dateCollection = $dateCollection;
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
     * @return \DateTime
     */
    public function getDateUpdate()
    {
        return $this->dateUpdate;
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
     * @param File $imageFile
     */
    public function setImageFile($imageFile )
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->setPhotoUpdatedAt(new \DateTime());

        }
    }






}



