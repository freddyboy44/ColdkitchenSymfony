<?php

namespace ColdkitchenBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * AchtergrondFoto
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ColdkitchenBundle\Entity\AchtergrondFotoRepository")
 */
class AchtergrondFoto
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
     * @ORM\Column(name="filename", type="string", length=255)
     */
    private $filename;

    /**
     * @var boolean
     *
     * @ORM\Column(name="zichtbaar", type="boolean")
     */
    private $zichtbaar;

    /**
     * @var boolean
     *
     * @ORM\Column(name="portrait", type="boolean")
     */
    private $portrait;


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
     * Set filename
     *
     * @param string $filename
     * @return AchtergrondFoto
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string 
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set zichtbaar
     *
     * @param boolean $zichtbaar
     * @return AchtergrondFoto
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
     * Get path to upload directory
     *
     * @return string
     *  Relative path
     */

    protected function getUploadPath()
    {
        return 'uploads/achtergrondfotos';
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
        return NULL === $this->getFilename()
            ? NULL
            : $this->getUploadPath() . '/' . $this->getFilename();
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
            : $this->getAbsolutePath() . '/' . $this->getFilename();
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
        $this->setFilename($filename);

        $this->setFile();

    }

    /**
     * Set portrait
     *
     * @param boolean $portrait
     * @return AchtergrondFoto
     */
    public function setPortrait($portrait)
    {
        $this->portrait = $portrait;

        return $this;
    }

    /**
     * Get portrait
     *
     * @return boolean 
     */
    public function getPortrait()
    {
        return $this->portrait;
    }
}
