<?php

namespace ColdkitchenBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Speler
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ColdkitchenBundle\Entity\SpelerRepository")
 */
class Speler
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
     * @ORM\Column(name="Naam", type="string", length=255, nullable=true)
     */
    private $naam;

    /**
     * @var string
     *
     * @ORM\Column(name="Voornaam", type="string", length=255, nullable=true)
     */
    private $voornaam;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Geboortedatum", type="date", nullable=true)
     */
    private $geboortedatum;

    /**
     * @var string
     *
     * @ORM\Column(name="Straat", type="string", length=255, nullable=true)
     */
    private $straat;

    /**
     * @var string
     *
     * @ORM\Column(name="Huisnr", type="string", length=255, nullable=true)
     */
    private $huisnr;

    /**
     * @var string
     *
     * @ORM\Column(name="Bus", type="string", length=255, nullable=true)
     */
    private $bus;

    /**
     * @var string
     *
     * @ORM\Column(name="Woonplaats", type="string", length=255, nullable=true)
     */
    private $woonplaats;

    /**
     * @var integer
     *
     * @ORM\Column(name="Postcode", type="integer", nullable=true)
     */
    private $postcode;

    /**
     * @var string
     *
     * @ORM\Column(name="Telefoon", type="string", length=255, nullable=true)
     */
    private $telefoon;

    /**
     * @var string
     *
     * @ORM\Column(name="GSM", type="string", length=255, nullable=true)
     */
    private $gsm;

    /**
     * @var string
     *
     * @ORM\Column(name="Emailadres", type="string", length=255, nullable=true)
     */
    private $emailadres;

    /**
     * @var integer
     *
     * @ORM\Column(name="Rugnummer", type="integer", nullable=true)
     */
    private $rugnummer;

    /**
     * @var integer
     *
     * @ORM\Column(name="Spelernummer", type="integer", nullable=true)
     */
    private $spelernummer;

    /**
     * @ORM\ManyToOne(targetEntity="Ploeg", inversedBy="spelers")
     * @ORM\JoinColumn(name="ploeg_id", referencedColumnName="id")
     */
    private $ploeg;


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
     * @return Speler
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
     * Set voornaam
     *
     * @param string $voornaam
     * @return Speler
     */
    public function setVoornaam($voornaam)
    {
        $this->voornaam = $voornaam;

        return $this;
    }

    /**
     * Get voornaam
     *
     * @return string 
     */
    public function getVoornaam()
    {
        return $this->voornaam;
    }

    /**
     * Set geboortedatum
     *
     * @param \DateTime $geboortedatum
     * @return Speler
     */
    public function setGeboortedatum($geboortedatum)
    {
        $this->geboortedatum = $geboortedatum;

        return $this;
    }

    /**
     * Get geboortedatum
     *
     * @return \DateTime 
     */
    public function getGeboortedatum()
    {
        return $this->geboortedatum;
    }

    /**
     * Set straat
     *
     * @param string $straat
     * @return Speler
     */
    public function setStraat($straat)
    {
        $this->straat = $straat;

        return $this;
    }

    /**
     * Get straat
     *
     * @return string 
     */
    public function getStraat()
    {
        return $this->straat;
    }

    /**
     * Set huisnr
     *
     * @param string $huisnr
     * @return Speler
     */
    public function setHuisnr($huisnr)
    {
        $this->huisnr = $huisnr;

        return $this;
    }

    /**
     * Get huisnr
     *
     * @return string 
     */
    public function getHuisnr()
    {
        return $this->huisnr;
    }

    /**
     * Set bus
     *
     * @param string $bus
     * @return Speler
     */
    public function setBus($bus)
    {
        $this->bus = $bus;

        return $this;
    }

    /**
     * Get bus
     *
     * @return string 
     */
    public function getBus()
    {
        return $this->bus;
    }

    /**
     * Set woonplaats
     *
     * @param string $woonplaats
     * @return Speler
     */
    public function setWoonplaats($woonplaats)
    {
        $this->woonplaats = $woonplaats;

        return $this;
    }

    /**
     * Get woonplaats
     *
     * @return string 
     */
    public function getWoonplaats()
    {
        return $this->woonplaats;
    }

    /**
     * Set postcode
     *
     * @param integer $postcode
     * @return Speler
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;

        return $this;
    }

    /**
     * Get postcode
     *
     * @return integer 
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * Set telefoon
     *
     * @param string $telefoon
     * @return Speler
     */
    public function setTelefoon($telefoon)
    {
        $this->telefoon = $telefoon;

        return $this;
    }

    /**
     * Get telefoon
     *
     * @return string 
     */
    public function getTelefoon()
    {
        return $this->telefoon;
    }

    /**
     * Set gSM
     *
     * @param string $gSM
     * @return Speler
     */
    public function setGSM($gsm)
    {
        $this->gsm = $gsm;

        return $this;
    }

    /**
     * Get gSM
     *
     * @return string 
     */
    public function getGSM()
    {
        return $this->gsm;
    }

    /**
     * Set emailadres
     *
     * @param string $emailadres
     * @return Speler
     */
    public function setEmailadres($emailadres)
    {
        $this->emailadres = $emailadres;

        return $this;
    }

    /**
     * Get emailadres
     *
     * @return string 
     */
    public function getEmailadres()
    {
        return $this->emailadres;
    }

    /**
     * Set rugnummer
     *
     * @param integer $rugnummer
     * @return Speler
     */
    public function setRugnummer($rugnummer)
    {
        $this->rugnummer = $rugnummer;

        return $this;
    }

    /**
     * Get rugnummer
     *
     * @return integer 
     */
    public function getRugnummer()
    {
        return $this->rugnummer;
    }

    /**
     * Set spelernummer
     *
     * @param integer $spelernummer
     * @return Speler
     */
    public function setSpelernummer($spelernummer)
    {
        $this->spelernummer = $spelernummer;

        return $this;
    }

    /**
     * Get spelernummer
     *
     * @return integer 
     */
    public function getSpelernummer()
    {
        return $this->spelernummer;
    }

    /**
     * Set ploeg
     *
     * @param \ColdkitchenBundle\Entity\Ploeg $ploeg
     * @return Speler
     */
    public function setPloeg(\ColdkitchenBundle\Entity\Ploeg $ploeg = null)
    {
        $this->ploeg = $ploeg;

        return $this;
    }

    /**
     * Get ploeg
     *
     * @return \ColdkitchenBundle\Entity\Ploeg 
     */
    public function getPloeg()
    {
        return $this->ploeg;
    }
}
