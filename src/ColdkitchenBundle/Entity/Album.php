<?php

namespace ColdkitchenBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Album
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ColdkitchenBundle\Entity\AlbumRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Album
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
     * @ORM\Column(name="Url", type="string", length=255)
     */
    private $url;

    /**
     * @var boolean
     *
     * @ORM\Column(name="Zichtbaar", type="boolean")
     */
    private $zichtbaar;

    /**
     * @var boolean
     *
     * @ORM\Column(name="Standaard", type="boolean")
     */
    private $standaard;

    /**
     * @var integer
     *
     * @ORM\Column(name="Volgorde", type="integer")
     */
    private $volgorde;

    /**
     * @ORM\PrePersist
     */
    public function setVolgordeValue()
    {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository('ColdkitchenBundle:Album')->createQueryBuilder('album');
        $qb->select('COUNT(album)');

        $count = $qb->getQuery()->getSingleScalarResult();

        $this->volgorde = $count;
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
     * @return Album
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
     * Set url
     *
     * @param string $url
     * @return Album
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set zichtbaar
     *
     * @param boolean $zichtbaar
     * @return Album
     */
    public function setZichtbaar($zichtbaar)
    {
        $this->zichtbaar = $zichtbaar;

        return $this;
    }

    /**
     * Get zichtbaar
     *
     * @return boolean 
     */
    public function getZichtbaar()
    {
        return $this->zichtbaar;
    }

    /**
     * Set standaard
     *
     * @param boolean $standaard
     * @return Album
     */
    public function setStandaard($standaard)
    {
        $this->standaard = $standaard;

        return $this;
    }

    /**
     * Get standaard
     *
     * @return boolean 
     */
    public function getStandaard()
    {
        return $this->standaard;
    }

    /**
     * Set volgorde
     *
     * @param integer $volgorde
     * @return Album
     */
    public function setVolgorde($volgorde)
    {
        $this->volgorde = $volgorde;

        return $this;
    }

    /**
     * Get volgorde
     *
     * @return integer 
     */
    public function getVolgorde()
    {
        return $this->volgorde;
    }
}
