<?php

namespace ademBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Produit
 *
 * @ORM\Table(name="produit")
 * @ORM\Entity
 * @Vich\Uploadable
 */
class Produit
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_produit", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    public $id_produit;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_produit", type="string", length=25, nullable=false)
     */
    public $nomProduit;

    /**
     * @var string
     *
     * @ORM\Column(name="type_produit", type="string", length=255, nullable=false)
     */
    public $typeProduit;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_produit", type="float", precision=10, scale=0, nullable=false)
     */
    public $prixProduit;

    /**
     * @var string
     *
     * @ORM\Column(name="image_produit", type="string", length=100, nullable=false)
     */
    public $imageProduit;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantite", type="integer", nullable=false)
     */
    public $quantite;

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
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="photoproduit", fileNameProperty="image_produit")
     *
     * @var File
     */
    public $imageFile;

    /**
     * Produit constructor.
     * @param int $idProduit
     * @param string $nomProduit
     * @param string $typeProduit
     * @param float $prixProduit
     * @param string $imageProduit
     * @param int $quantite
     */
    public function __construct($idProduit=null, $nomProduit=null, $typeProduit=null, $prixProduit=null, $imageProduit=null, $quantite=null)
    {
        $this->idProduit = $idProduit;
        $this->nomProduit = $nomProduit;
        $this->typeProduit = $typeProduit;
        $this->prixProduit = $prixProduit;
        $this->imageProduit = $imageProduit;
        $this->quantite = $quantite;
    }

    /**
     * @return int
     */
    public function getId_Produit()
    {
        return $this->id_produit;
    }

    /**
     * @param int $id_Produit
     */
    public function setId_Produit($id_Produit)
    {
        $this->id_Produit = $id_produit;
    }

    /**
     * @return string
     */
    public function getNomProduit()
    {
        return $this->nomProduit;
    }

    /**
     * @param string $nomProduit
     */
    public function setNomProduit($nomProduit)
    {
        $this->nomProduit = $nomProduit;
    }

    /**
     * @return string
     */
    public function getTypeProduit()
    {
        return $this->typeProduit;
    }

    /**
     * @param string $typeProduit
     */
    public function setTypeProduit($typeProduit)
    {
        $this->typeProduit = $typeProduit;
    }

    /**
     * @return float
     */
    public function getPrixProduit()
    {
        return $this->prixProduit;
    }

    /**
     * @param float $prixProduit
     */
    public function setPrixProduit($prixProduit)
    {
        $this->prixProduit = $prixProduit;
    }

    /**
     * @return string
     */
    public function getImageProduit()
    {
        return $this->imageProduit;
    }

    /**
     * @param string $imageProduit
     */
    public function setImageProduit($imageProduit)
    {
        $this->imageProduit = $imageProduit;
    }

    /**
     * @return int
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * @param int $quantite
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;
    }

    /**
     * @param \DateTime $photoUpdatedAt
     */
    public function setPhotoUpdatedAt($photoUpdatedAt)
    {
        $this->photoUpdatedAt = $photoUpdatedAt;
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




}

