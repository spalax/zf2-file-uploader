<?php
namespace Zf2FileUploader\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zf2FileUploader\Resource\ResourceInterface;

/**
 * Resource
 *
 * @ORM\Table(name="resource")
 * @ORM\Entity
 */
class Resource implements ResourceInterface
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
}