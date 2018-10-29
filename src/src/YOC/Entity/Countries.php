<?php

namespace YOC\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Countries
 *
 * @ORM\Table(name="countries", uniqueConstraints={@ORM\UniqueConstraint(name="country_name", columns={"country_name"})})
 * @ORM\Entity(repositoryClass="YOC\Entity\Repository\CountriesRepository")
 */
class Countries
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
     * @ORM\Column(name="country_name", type="string", length=255, nullable=false)
     */
    private $countryName;

    /**
     * @var string
     *
     * @ORM\Column(name="country_code", type="string", length=10, nullable=false)
     */
    private $countryCode;

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
    public function getCountryName()
    {
        return $this->countryName;
    }

    /**
     * @param string $countryName
     */
    public function setCountryName($countryName)
    {
        $this->countryName = $countryName;
    }

    /**
     * @return string
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * @param string $countryCode
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;
    }


}
