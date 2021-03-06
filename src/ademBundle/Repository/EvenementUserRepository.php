<?php

namespace ademBundle\Repository;

use ademBundle\Entity\Film;
use ademBundle\Entity\User;

/**
 * EvenementUserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EvenementUserRepository extends \Doctrine\ORM\EntityRepository
{
    public function getParticipation($idevenement ,$iduser)
    {

        $query = $this->createQueryBuilder('p')
            ->where('p.iduser = :iduser')
            ->andWhere('p.idevenement = :idevenement')
            ->setParameters(array(
                    'iduser'=>$iduser,
                    'idevenement'=>$idevenement,
                )
            )
            ->getQuery();
        return $query->getResult();
    }

}

