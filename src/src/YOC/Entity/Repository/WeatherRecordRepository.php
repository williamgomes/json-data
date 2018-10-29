<?php

namespace YOC\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\AST\Join;
use YOC\Entity\Cities;
use YOC\Entity\Countries;
use Doctrine\ORM\Query\ResultSetMapping;

/**
 * Class CountriesRepository
 * @package YOC\Entity\Repository
 */
class WeatherRecordRepository extends EntityRepository
{
    /**
     * @return mixed
     */
    public function getLatestSevenRecords()
    {
//        $sSql = '
//            SELECT wr.avgTemp, ci.cityName FROM weather_record AS wr
//            INNER JOIN cities AS ci ON ci.id = wr.cityId
//            INNER JOIN countries AS co ON co.id = wr.countryId
//        ';
//
//        $oCon = $this->getEntityManager()->getConnection();
//        $stmt = $oCon->prepare($sSql);
////        $stmt->execute(array('category' => $category->getId()));
//        $stmt->fetchAll();


//        $oCon->prepare()

//        $rsm = new ResultSetMapping();
//// build rsm here
//
//        $query = $this->createNativeNamedQuery('SELECT id, name, discr FROM users WHERE name = ?', $rsm);
//        $query->setParameter(1, 'romanb');
//
//        $users = $query->getResult();
//
//

        $oSubQuery = $this->createQueryBuilder('wrec')
            ->select('MAX(wrec.recordDate) as maxDate')
            ->where('wrec.country = :country')
            ->andWhere('wrec.city = :city')
            ->groupBy('wrec.country')
            ->addGroupBy('wrec.city');

        $oQueryBuilder = $this->createQueryBuilder('wr');

        return $oQueryBuilder->select('wr.avgTemp, ci.cityName, co.countryName')
            ->innerJoin('wr.city', 'ci')
            ->innerJoin('wr.country', 'co')
            ->where(
                $oQueryBuilder->expr()->lte('wr.recordDate', '(' . $oSubQuery->getDQL() . ')')
            )
            ->setParameter(':country', 'wr.country')
            ->setParameter(':city', 'wr.city')
            ->getDQL();
//            ->getQuery()
//            ->getResult();
    }
}