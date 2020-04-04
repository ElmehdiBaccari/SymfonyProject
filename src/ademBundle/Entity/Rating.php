<?php

namespace ademBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rating
 *
 * @ORM\Table(name="rating", indexes={@ORM\Index(name="fk_idfil", columns={"id_film"}), @ORM\Index(name="fk_iduser", columns={"id_user"})})
 * @ORM\Entity(repositoryClass="ademBundle\Repository\RatingRepository")
 */
class Rating
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_rating", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id_rating;

    /**
     * @var integer
     *
     * @ORM\Column(name="rating", type="integer", nullable=false)
     */
    private $rating;

    /**
     * @var \ademBundle\Entity\Film
     *
     * @ORM\ManyToOne(targetEntity="ademBundle\Entity\Film")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_film", referencedColumnName="id")
     * })
     */
    private $id_film;

    /**
     * @var \ademBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="ademBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     * })
     */
    private $id_user;

    /**
     * Rating constructor.
     * @param int $id_rating
     * @param int $rating
     * @param Film $id_film
     * @param User $id_user
     */
    public function __construct($id_rating = null, $rating = null, Film $id_film = null, Utilisateur $id_user = null)
    {
        $this->id_rating = $id_rating;
        $this->rating = $rating;
        $this->id_film = $id_film;
        $this->id_user = $id_user;
    }

    /**
     * @return int
     */
    public function getIdRating()
    {
        return $this->id_rating;
    }

    /**
     * @param int $id_rating
     */
    public function setIdRating($id_rating)
    {
        $this->id_rating = $id_rating;
    }

    /**
     * @return int
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param int $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * @return Film
     */
    public function getIdFilm()
    {
        return $this->id_film;
    }

    /**
     * @param Film $id_film
     */
    public function setIdFilm($id_film)
    {
        $this->id_film = $id_film;
    }

    /**
     * @return Utilisateur
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * @param Utilisateur $id_user
     */
    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;
    }




}

