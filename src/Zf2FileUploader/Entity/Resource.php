<?php
namespace Zf2FileUploader\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zf2FileUploader\Resource\ResourceRemovableInterface;

/**
 * Resource
 *
 * @ORM\Table(name="resource")
 * @ORM\Entity
 */
class Resource implements ResourceRemovableInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=250, nullable=false)
     */
    private $path;

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=50, nullable=false)
     */
    private $token;

    /**
     * @var boolean
     *
     * @ORM\Column(name="temp", type="boolean", nullable=false, options={"unsigned"=true})
     */
    private $temp = 1;

    /**
     * @var \Image
     *
     * @ORM\OneToOne(targetEntity="Image", mappedBy="resource", fetch="EXTRA_LAZY")
     */
    private $image;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_timestamp", type="datetime", nullable=false)
     */
    private $createdTimestamp;

    /**
     * Set temp
     *
     * @param boolean $temp
     * @return Resource
     */
    public function setTemp($temp)
    {
        $this->temp = $temp;

        return $this;
    }

    /**
     * Get temp
     *
     * @return boolean
     */
    public function getTemp()
    {
        return $this->temp;
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
     * Set id
     *
     * @return Resource
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return Resource
     */
    public function setPath($path)
    {
        $this->path = $path;
    
        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set token
     *
     * @param string $path
     * @return Resource
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set image
     *
     * @param \Zf2FileUploader\Entity\ImageInterface $image
     * @return Resource
     */
    public function setImage(\Zf2FileUploader\Entity\ImageInterface $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Zf2FileUploader\Entity\ImageInterface
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set createdTimestamp
     *
     * @param \DateTime $createdTimestamp
     * @return Resource
     */
    public function setCreatedTimestamp($createdTimestamp)
    {
        $this->createdTimestamp = $createdTimestamp;

        return $this;
    }

    /**
     * Get createdTimestamp
     *
     * @return \DateTime
     */
    public function getCreatedTimestamp()
    {
        return $this->createdTimestamp;
    }
}