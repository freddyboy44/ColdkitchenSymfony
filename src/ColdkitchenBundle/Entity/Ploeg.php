<?php

namespace ColdkitchenBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Ploeg
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ColdkitchenBundle\Entity\PloegRepository")
 */
class Ploeg implements UserInterface, \Serializable
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
     * @ORM\Column(name="Ploegnaam", type="string", length=255)
     */
    private $ploegnaam;

    /**
     * @var string
     *
     * @ORM\Column(name="Wachtwoord", type="string", length=255, nullable=true)
     */
    private $wachtwoord;

    /**
     * @var string
     *
     * @ORM\Column(name="KapiteinNaam", type="string", length=255)
     */
    private $kapiteinNaam;

    /**
     * @var string
     *
     * @ORM\Column(name="KapiteinVoornaam", type="string", length=255)
     */
    private $kapiteinVoornaam;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Geboortedatum", type="date")
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
     * @var integer
     *
     * @ORM\Column(name="Postcode", type="integer", nullable=true)
     */
    private $postcode;

    /**
     * @var string
     *
     * @ORM\Column(name="Woonplaats", type="string", length=255, nullable=true)
     */
    private $woonplaats;

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
    private $gSM;

    /**
     * @var string
     *
     * @ORM\Column(name="Emailadres", type="string", length=255, nullable=true)
     */
    private $emailadres;

    /**
     * @ORM\ManyToOne(targetEntity="Competitie", inversedBy="ploegen")
     * @ORM\JoinColumn(name="competitie_id", referencedColumnName="id")
     */
    private $competitie;

    /**
     * @ORM\OneToMany(targetEntity="Speler", mappedBy="ploeg", cascade={"all"}, fetch="EAGER")
     */
    private $spelers;



    

    public function getUsername()
    {
        return $this->emailadres;
    }

    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    public function getPassword()
    {
        return $this->wachtwoord;
    }
    public function setPassword($paswoord)

    {
        $this->wachtwoord = $paswoord;

        return $this;
    }

    /**
     * 
     * @param [type] $username [description]
     */
    public function setUsername($username){
        $this->emailadres = $username;
        return $this;
    }

    public function getRoles()
    {
        return array('ROLE_USER');
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->emailadres,
            $this->wachtwoord,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->emailadres,
            $this->wachtwoord,
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized);
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
     * Set ploegnaam
     *
     * @param string $ploegnaam
     * @return Ploeg
     */
    public function setPloegnaam($ploegnaam)
    {
        $this->ploegnaam = $ploegnaam;

        return $this;
    }

    /**
     * Get ploegnaam
     *
     * @return string 
     */
    public function getPloegnaam()
    {
        return $this->ploegnaam;
    }

    /**
     * Set kapiteinNaam
     *
     * @param string $kapiteinNaam
     * @return Ploeg
     */
    public function setKapiteinNaam($kapiteinNaam)
    {
        $this->kapiteinNaam = $kapiteinNaam;

        return $this;
    }

    /**
     * Get kapiteinNaam
     *
     * @return string 
     */
    public function getKapiteinNaam()
    {
        return $this->kapiteinNaam;
    }

    /**
     * Set kapiteinVoornaam
     *
     * @param string $kapiteinVoornaam
     * @return Ploeg
     */
    public function setKapiteinVoornaam($kapiteinVoornaam)
    {
        $this->kapiteinVoornaam = $kapiteinVoornaam;

        return $this;
    }

    /**
     * Get kapiteinVoornaam
     *
     * @return string 
     */
    public function getKapiteinVoornaam()
    {
        return $this->kapiteinVoornaam;
    }

    /**
     * Set geboortedatum
     *
     * @param \DateTime $geboortedatum
     * @return Ploeg
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
     * @return Ploeg
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
     * @return Ploeg
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
     * @return Ploeg
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
     * Set postcode
     *
     * @param integer $postcode
     * @return Ploeg
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
     * Set woonplaats
     *
     * @param string $woonplaats
     * @return Ploeg
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
     * Set telefoon
     *
     * @param string $telefoon
     * @return Ploeg
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
     * @return Ploeg
     */
    public function setGSM($gSM)
    {
        $this->gSM = $gSM;

        return $this;
    }

    /**
     * Get wachtwoord
     *
     * @return string 
     */
    public function getWachtwoord()
    {
        return $this->wachtwoord;
    }

    /**
     * Set wachtwoord
     *
     * @param string $wachtwoord
     * @return Ploeg
     */
    public function setWachtwoord($wachtwoord)
    {
        $this->wachtwoord = $wachtwoord;

        return $this;
    }

    /**
     * Get gSM
     *
     * @return string 
     */
    public function getGSM()
    {
        return $this->gSM;
    }

    /**
     * Set emailadres
     *
     * @param string $emailadres
     * @return Ploeg
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
     * Constructor
     */
    public function __construct()
    {
        $this->spelers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set competitie
     *
     * @param \ColdkitchenBundle\Entity\Competitie $competitie
     * @return Ploeg
     */
    public function setCompetitie(\ColdkitchenBundle\Entity\Competitie $competitie = null)
    {
        $this->competitie = $competitie;

        return $this;
    }

    /**
     * Get competitie
     *
     * @return \ColdkitchenBundle\Entity\Competitie 
     */
    public function getCompetitie()
    {
        return $this->competitie;
    }

    /**
     * Add spelers
     *
     * @param \ColdkitchenBundle\Entity\Speler $spelers
     * @return Ploeg
     */
    public function addSpeler(\ColdkitchenBundle\Entity\Speler $spelers)
    {
        $this->spelers[] = $spelers;

        return $this;
    }

    /**
     * Remove spelers
     *
     * @param \ColdkitchenBundle\Entity\Speler $spelers
     */
    public function removeSpeler(\ColdkitchenBundle\Entity\Speler $spelers)
    {
        $this->spelers->removeElement($spelers);
    }

    /**
     * Get spelers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSpelers()
    {
        return $this->spelers;
    }
}
