<?php

namespace YOC\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cities
 *
 * @ORM\Table(name="cities", indexes={@ORM\Index(name="cities_countries_fk_idx", columns={"country_id"})})
 * @ORM\Entity(repositoryClass="YOC\Entity\Repository\CitiesRepository")
 */
class Cities
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="country_id", type="integer", nullable=false)
     */
    private $countryId;

    /**
     * @var string
     *
     * @ORM\Column(name="city_name", type="string", length=255, nullable=false)
     */
    private $cityName;

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

    /**
     * @return int
     */
    public function getCountryId()
    {
        return $this->countryId;
    }

    /**
     * @param int $countryId
     */
    public function setCountryId($countryId)
    {
        $this->countryId = $countryId;
    }

    /**
     * @return string
     */
    public function getCityName()
    {
        return $this->cityName;
    }

    /**
     * @param string $cityName
     */
    public function setCityName($cityName)
    {
        $this->cityName = $cityName;
    }


}
