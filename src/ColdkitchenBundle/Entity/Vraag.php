<?php

namespace ColdkitchenBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vraag
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ColdkitchenBundle\Entity\VraagRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Vraag
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
     * @var string
     *
     * @ORM\Column(name="Email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="Telefoon", type="string", length=255)
     */
    private $telefoon;

    /**
     * @var string
     *
     * @ORM\Column(name="Tekst", type="text")
     */
    private $tekst;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DatumVerstuurd", type="datetime")
     */
    private $datumVerstuurd;

    /**
     * Set datumVerstuurd
     *
     * @param \DateTime $datumVerstuurd
     * @ORM\PrePersist
     * @return Example
     */
    public function setDatumVerstuurd()
    {

        if(!$this->datumVerstuurd){
            $this->datumVerstuurd = new \DateTime();
        }

        return $this;
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
     * @return Vraag
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
     * Set email
     *
     * @param string $email
     * @return Vraag
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set telefoon
     *
     * @param string $telefoon
     * @return Vraag
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
     * Set tekst
     *
     * @param string $tekst
     * @return Vraag
     */
    public function setTekst($tekst)
    {
        $this->tekst = $tekst;

        return $this;
    }

    /**
     * Get tekst
     *
     * @return string 
     */
    public function getTekst()
    {
        return $this->tekst;
    }

    
    /**
     * Get datumVerstuurd
     *
     * @return \DateTime 
     */
    public function getDatumVerstuurd()
    {
        return $this->datumVerstuurd;
    }
}
