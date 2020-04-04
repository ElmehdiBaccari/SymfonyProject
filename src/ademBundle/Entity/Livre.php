<?php

namespace ademBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Livre
 *
 * @ORM\Table(name="livre")
 * @ORM\Entity
 * @Vich\Uploadable
 */
class Livre
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_livre", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    public $id_livre;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="titre_livre", type="string", length=20, nullable=false)
     */
    public $titreLivre;

    /**
     * @var \DateTime
     * @ORM\Column(name="date_edition", type="date", nullable=false)
     */
    public $dateEdition;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="description", type="string", precision=10, length=5000, scale=0, nullable=false)
     */
    public $descriptionLivre;

    /**
     * @var integer
     * @Assert\GreaterThanOrEqual(0)
     * @ORM\Column(name="qte_livre", type="integer", nullable=false)
     */
    public $qteLivre;

    /**
     * @var string
     *
     * @ORM\Column(name="categorie_livre", type="string", length=30, nullable=false)
     */
    public $categorieLivre;




    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="photolivre", fileNameProperty="image")
     *
     * @var File
     */
    public $imageFile;




    /**
     * @var string
     *
     * @ORM\Column(name="image", type="text", length=65535, nullable=false)
     */
    public $image;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="auteur", type="string", length=200, nullable=false)
     */
    public $auteur;

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
     * Livre constructor.
     * @param int $id_livre
     * @param string $titreLivre
     * @param \DateTime $dateEdition
     * @param string $descriptionLivre
     * @param int $qteLivre
     * @param string $categorieLivre
     * @param File $imageFile
     * @param string $image
     * @param string $auteur
     * @param \DateTime $photoUpdatedAt
     * @param \DateTime $dateCreation
     * @param \DateTime $dateUpdate
     */
    public function __construct($id_livre = null, $titreLivre = null, \DateTime $dateEdition = null, $descriptionLivre = null, $qteLivre = null, $categorieLivre = null, File $imageFile = null, $image = null, $auteur = null, \DateTime $photoUpdatedAt = null, \DateTime $dateCreation = null, \DateTime $dateUpdate = null)
    {
        $this->id_livre = $id_livre;
        $this->titreLivre = $titreLivre;
        $this->dateEdition = $dateEdition;
        $this->descriptionLivre = $descriptionLivre;
        $this->qteLivre = $qteLivre;
        $this->categorieLivre = $categorieLivre;
        $this->imageFile = $imageFile;
        $this->image = $image;
        $this->auteur = $auteur;
        $this->photoUpdatedAt = $photoUpdatedAt;
        $this->dateCreation = $dateCreation;
        $this->dateUpdate = $dateUpdate;
    }


    /**
     * @return int
     */
    public function getId_livre()
    {
        return $this->id_livre;
    }

    /**
     * @param int $idLivre
     */
    public function setId_livre($id_livre)
    {
        $this->id_livre = $id_livre;
    }

    /**
     * @return string
     */
    public function getTitreLivre()
    {
        return $this->titreLivre;
    }

    /**
     * @param string $titreLivre
     */
    public function setTitreLivre($titreLivre)
    {
        $this->titreLivre = $titreLivre;
    }

    /**
     * @return \DateTime
     */
    public function getDateEdition()
    {
        return $this->dateEdition;
    }

    /**
     * @param \DateTime $dateEdition
     */
    public function setDateEdition($dateEdition)
    {
        $this->dateEdition = $dateEdition;
    }

    /**
     * @return float
     */
    public function getdescriptionLivre()
    {
        return $this->descriptionLivre;
    }

    /**
     * @param float $descriptionLivre
     */
    public function setdescriptionLivre($descriptionLivre)
    {
        $this->descriptionLivre = $descriptionLivre;
    }

    /**
     * @return int
     */
    public function getQteLivre()
    {
        return $this->qteLivre;
    }

    /**
     * @param int $qteLivre
     */
    public function setQteLivre($qteLivre)
    {
        $this->qteLivre = $qteLivre;
    }

    /**
     * @return string
     */
    public function getCategorieLivre()
    {
        return $this->categorieLivre;
    }

    /**
     * @param string $categorieLivre
     */
    public function setCategorieLivre($categorieLivre)
    {
        $this->categorieLivre = $categorieLivre;
    }

    /**
     * @return File
     */
    public function getImageFile()
    {
        return $this->imageFile;
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

    /**
     * @return int
     */



}