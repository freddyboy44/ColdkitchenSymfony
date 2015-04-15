<?php

namespace ColdkitchenBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Competitie
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ColdkitchenBundle\Entity\CompetitieRepository")
 */
class Competitie
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Naam", type="string", length=255)
     */
    private $naam;

    /**
     * @ORM\OneToMany(targetEntity="Ploeg", mappedBy="competitie", cascade={"all"}, fetch="EAGER")
     */
    protected $ploegen;

    public function __construct()
    {
        $this->ploegen = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->naam;
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set naam
     *
     * @param string $naam
     * @return Competitie
     */
    public function setNaam($naam)
    {
        $this->naam = $naam;

        return $this;
    }

    /**
     * Get naam
     *
     * @return string 
     */
    public function getNaam()
    {
        return $this->naam;
    }

    /**
     * Add ploegen
     *
     * @param \ColdkitchenBundle\Entity\Ploeg $ploegen
     * @return Competitie
     */
    public function addPloegen(\ColdkitchenBundle\Entity\Ploeg $ploegen)
    {
        $this->ploegen[] = $ploegen;

        return $this;
    }

    /**
     * Remove ploegen
     *
     * @param \ColdkitchenBundle\Entity\Ploeg $ploegen
     */
    public function removePloegen(\ColdkitchenBundle\Entity\Ploeg $ploegen)
    {
        $this->ploegen->removeElement($ploegen);
    }

    /**
     * Get ploegen
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPloegen()
    {
        return $this->ploegen;
    }
}
