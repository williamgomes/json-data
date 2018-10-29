<?php

namespace YOC\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WeatherRecord
 *
 * @ORM\Table(name="weather_record", uniqueConstraints={@ORM\UniqueConstraint(name="id_UNIQUE", columns={"id"})}, indexes={@ORM\Index(name="weather_record_countries_id_fk", columns={"country_id"}), @ORM\Index(name="weather_record_cities_id_fk", columns={"city_id"})})
 * @ORM\Entity(repositoryClass="YOC\Entity\Repository\WeatherRecordRepository")
 */
class WeatherRecord
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
     * @var string
     *
     * @ORM\Column(name="timezone", type="string", length=100, nullable=false)
     */
    private $timezone;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="record_date", type="date", nullable=false)
     */
    private $recordDate;

    /**
     * @var string
     *
     * @ORM\Column(name="max_temp", type="decimal", precision=11, scale=2, nullable=false)
     */
    private $maxTemp;

    /**
     * @var string
     *
     * @ORM\Column(name="min_temp", type="decimal", precision=11, scale=2, nullable=false)
     */
    private $minTemp;

    /**
     * @var string
     *
     * @ORM\Column(name="avg_temp", type="decimal", precision=11, scale=2, nullable=false)
     */
    private $avgTemp;

    /**
     * @var string
     *
     * @ORM\Column(name="created_at", type="string", length=45, nullable=false)
     */
    private $createdAt;

    /**
     * @var \Cities
     *
     * @ORM\ManyToOne(targetEntity="Cities")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="city_id", referencedColumnName="id")
     * })
     */
    private $city;

    /**
     * @var \Countries
     *
     * @ORM\ManyToOne(targetEntity="Countries")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="country_id", referencedColumnName="id")
     * })
     */
    private $country;

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
     * @return string
     */
    public function getTimezone()
    {
        return $this->timezone;
    }

    /**
     * @param string $timezone
     */
    public function setTimezone($timezone)
    {
        $this->timezone = $timezone;
    }

    /**
     * @return DateTime
     */
    public function getRecordDate()
    {
        return $this->recordDate;
    }

    /**
     * @param DateTime $recordDate
     */
    public function setRecordDate($recordDate)
    {
        $this->recordDate = $recordDate;
    }

    /**
     * @return string
     */
    public function getMaxTemp()
    {
        return $this->maxTemp;
    }

    /**
     * @param string $maxTemp
     */
    public function setMaxTemp($maxTemp)
    {
        $this->maxTemp = $maxTemp;
    }

    /**
     * @return string
     */
    public function getMinTemp()
    {
        return $this->minTemp;
    }

    /**
     * @param string $minTemp
     */
    public function setMinTemp($minTemp)
    {
        $this->minTemp = $minTemp;
    }

    /**
     * @return string
     */
    public function getAvgTemp()
    {
        return $this->avgTemp;
    }

    /**
     * @param string $avgTemp
     */
    public function setAvgTemp($avgTemp)
    {
        $this->avgTemp = $avgTemp;
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param string $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return Cities
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param Cities $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return Countries
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param Countries $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

}
