<?php

namespace EvaluationBundle\Repository;

/**
 * matiereRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class matiereRepository extends \Doctrine\ORM\EntityRepository
{
    public function findSubjectByName($searchName){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT s
                FROM EvaluationBundle:Matiere s
                WHERE s.nom LIKE :searchName '
            )
            ->setParameter('searchName', '%'.$searchName.'%')
            ->getResult();
    }

    public function findHighest(){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT s
                FROM EvaluationBundle:Matiere s
                ORDER BY s.coeff ASC '
            )
            ->getResult();
    }
}
