<?php

namespace YOC\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class CountriesRepository
 * @package YOC\Entity\Repository
 */
class CountriesRepository extends EntityRepository
{
    public function getCountryByCode($sCountryCode = '')
    {
        return $this->createQueryBuilder('c')
            ->select('c')
            ->andWhere('c.countryCode = :countryCode')
            ->setParameter('countryCode', $sCountryCode)
            ->getQuery()
            ->getOneOrNullResult();
    }
}