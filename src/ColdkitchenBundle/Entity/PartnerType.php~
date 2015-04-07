<?php

namespace ColdkitchenBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * PartnerType
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ColdkitchenBundle\Entity\PartnerTypeRepository")
 */
class PartnerType
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
     * @var integer
     *
     * @ORM\Column(name="Hoogte", type="integer")
     */
    private $hoogte;

    /**
     * @var integer
     *
     * @ORM\Column(name="Breedte", type="integer")
     */
    private $breedte;

    /**
     * @ORM\OneToMany(targetEntity="Partner", mappedBy="typepartner", cascade={"all"}, fetch="EAGER")
     */
    protected $partners;

    public function __construct()
    {
        $this->partners = new ArrayCollection();
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
     * @return PartnerType
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
     * Set hoogte
     *
     * @param integer $hoogte
     * @return PartnerType
     */
    public function setHoogte($hoogte)
    {
        $this->hoogte = $hoogte;

        return $this;
    }

    /**
     * Get hoogte
     *
     * @return integer 
     */
    public function getHoogte()
    {
        return $this->hoogte;
    }

    /**
     * Set breedte
     *
     * @param integer $breedte
     * @return PartnerType
     */
    public function setBreedte($breedte)
    {
        $this->breedte = $breedte;

        return $this;
    }

    /**
     * Get breedte
     *
     * @return integer 
     */
    public function getBreedte()
    {
        return $this->breedte;
    }

    

    /**
     * Sets the value of id.
     *
     * @param integer $id the id
     *
     * @return self
     */
    private function _setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Sets the value of naam.
     *
     * @param string $naam the naam
     *
     * @return self
     */
    private function _setNaam($naam)
    {
        $this->naam = $naam;

        return $this;
    }

    /**
     * Sets the value of hoogte.
     *
     * @param integer $hoogte the hoogte
     *
     * @return self
     */
    private function _setHoogte($hoogte)
    {
        $this->hoogte = $hoogte;

        return $this;
    }

    /**
     * Sets the value of breedte.
     *
     * @param integer $breedte the breedte
     *
     * @return self
     */
    private function _setBreedte($breedte)
    {
        $this->breedte = $breedte;

        return $this;
    }

    /**
     * Gets the value of partners.
     *
     * @return mixed
     */
    public function getPartners()
    {
        return $this->partners;
    }

    /**
     * Sets the value of partners.
     *
     * @param mixed $partners the partners
     *
     * @return self
     */
    protected function setPartners($partners)
    {
        $this->partners = $partners;

        return $this;
    }

    /**
     * Add partners
     *
     * @param \ColdkitchenBundle\Entity\Partner $partners
     * @return PartnerType
     */
    public function addPartner(\ColdkitchenBundle\Entity\Partner $partners)
    {
        $this->partners[] = $partners;

        return $this;
    }

    /**
     * Remove partners
     *
     * @param \ColdkitchenBundle\Entity\Partner $partners
     */
    public function removePartner(\ColdkitchenBundle\Entity\Partner $partners)
    {
        $this->partners->removeElement($partners);
    }
}
