<?php
namespace Zf2FileUploader\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Image
 *
 * @ORM\Table(name="image")
 * @ORM\Entity
 */
class Image implements ImageInterface
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
     * @ORM\Column(name="alt", type="string", length=250, nullable=false)
     */
    private $alt = '';

    /**
     * @var \Resource
     *
     * @ORM\OneToOne(targetEntity="Resource", inversedBy="image", fetch="EXTRA_LAZY")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="resource_id", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
    private $resource;

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
     * Set alt
     *
     * @param string $alt
     * @return Image
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * Set resource
     *
     * @param \Zf2FileUploader\Entity\Resource $resource
     * @return Image
     */
    public function setResource(\Zf2FileUploader\Entity\Resource $resource = null)
    {
        $this->resource = $resource;

        return $this;
    }

    /**
     * Get resource
     *
     * @return \Zf2FileUploader\Entity\Resource
     */
    public function getResource()
    {
        return $this->resource;
    }
}