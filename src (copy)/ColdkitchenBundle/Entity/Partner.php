<?php

namespace ColdkitchenBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Partner
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ColdkitchenBundle\Entity\PartnerRepository")
 */
class Partner
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
     * @ORM\Column(name="Website", type="string", length=255)
     */
    private $website;

    /**
     * @var boolean
     *
     * @ORM\Column(name="Zichtbaar", type="boolean")
     */
    private $zichtbaar;

    /**
     * @var string
     *
     * @ORM\Column(name="Logo", type="string", length=255)
     */
    private $logo;

    /**
     * @ORM\ManyToOne(targetEntity="PartnerType", inversedBy="partners")
     * @ORM\JoinColumn(name="typepartner_id", referencedColumnName="id")
     */
    protected $typepartner;


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
     * @return Partner
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
     * Set website
     *
     * @param string $website
     * @return Partner
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string 
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set zichtbaar
     *
     * @param boolean $zichtbaar
     * @return Partner
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
     * Set logo
     *
     * @param string $logo
     * @return Partner
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string 
     */
    public function getLogo()
    {
        return $this->logo;
    }


    protected function getUploadPath()
    {
        return 'uploads/partners';
    }

    /**
     * Get absolute path to upload directory
     *
     * @return string
     *  absolute path
     */

    protected function getAbsolutePath()
    {
        return '/var/www/html/ColdkitchenSymfony/web/'.$this->getUploadPath();
    }

    /**
     * Get the relative logo for the website
     *
     * @return string
     *  relative logo path
     */

    public function getLogoWeb() 
    {
        return NULL === $this->getLogo()
            ? NULL
            : $this->getUploadPath() . '/' . $this->getLogo();
    }

    /**
     * Get the absolute logo for the website
     *
     * @return string
     *  absolute logo path
     */

    public function getLogoAbsolute() 
    {
        return NULL === $this->getLogo()
            ? NULL
            : $this->getAbsolutePath() . '/' . $this->getLogo();
    }    

    /**
     * @Assert\File(maxSize="5000000")
     */
    private $file;


    /*
    *   Sets file
    */
    public function setFile(UploadedFile $file = NULL) {
        $this->file = $file;
    }

    /*
    *   Gets file
    *   @return UploadedFile
    */
    public function getFile() {
        return $this->file;
    }

    /*
    * Upload the file
    */

    public function upload(){
        if( NULL === $this->getFile()){
            return;
        }
        $filename= $this->getFile()->getClientOriginalName();

        // Move to the target directory
        
        $this->getFile()->move(
            $this->getAbsolutePath(), 
            $filename);

        //Set the logo
        $this->setLogo($filename);

        $this->setFile();
    }

    /**
     * Sets the value of id.
     *
     * @param integer $id the id
     *
     * @return self
     */
    public function _setId($id)
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
    public function _setNaam($naam)
    {
        $this->naam = $naam;

        return $this;
    }

    /**
     * Sets the value of website.
     *
     * @param string $website the website
     *
     * @return self
     */
    public function _setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Sets the value of zichtbaar.
     *
     * @param boolean $zichtbaar the zichtbaar
     *
     * @return self
     */
    public function _setZichtbaar($zichtbaar)
    {
        $this->zichtbaar = $zichtbaar;

        return $this;
    }

    /**
     * Sets the value of logo.
     *
     * @param string $logo the logo
     *
     * @return self
     */
    public function _setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Gets the value of typepartner.
     *
     * @return mixed
     */
    public function getTypepartner()
    {
        return $this->typepartner;
    }

    /**
     * Sets the value of typepartner.
     *
     * @param mixed $typepartner the typepartner
     *
     * @return self
     */
    public function setTypepartner($typepartner)
    {
        $this->typepartner = $typepartner;

        return $this;
    }

    /**
     * Sets the value of file.
     *
     * @param mixed $file the file
     *
     * @return self
     */
    public function _setFile($file)
    {
        $this->file = $file;

        return $this;
    }
}
