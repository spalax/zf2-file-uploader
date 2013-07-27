<?php
namespace Zf2FileUploader\Resource;

use Zf2FileUploader\Entity\ImageInterface;

class ImageResource extends AbstractResource implements ImageResourceInterface
{
    /**
     * @var ImageResource | null
     */
    protected $resourceEntity = null;

    /**
     * @var string
     */
    protected $httpPath = '';

    /**
     * @param string $httpPath
     * @return ImageResource
     */
    public function setHttpPath($httpPath)
    {
        $this->httpPath = $httpPath;
        return $this;
    }

    /**
     * @return string
     */
    public function getHttpPath()
    {
        return $this->httpPath;
    }

    /**
     * @return ImageResource
     */
    public function getEntity()
    {
        return $this->resourceEntity;
    }

    /**
     * @param ImageInterface $entity
     * @return ImageResource
     */
    public function setEntity(ImageInterface $entity)
    {
        $this->resourceEntity = $entity;
        return $this;
    }
}