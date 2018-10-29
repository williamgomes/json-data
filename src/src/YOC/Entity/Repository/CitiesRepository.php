<?php

namespace YOC\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class CitiesRepository
 * @package YOC\Entity\Repository
 */
class CitiesRepository extends EntityRepository
{
    /**
     * @return mixed
     */
    public function getAllCitiesGroupedBy()
    {
        return $this->createQueryBuilder('c')
        ->select('c.countryId, c.cityName')
        ->groupBy('c.cityName')
        ->getQuery()
        ->getOneOrNullResult();
    }
}