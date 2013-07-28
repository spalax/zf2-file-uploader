<?php
namespace Zf2FileUploader\Resource\Persisted;

use Zf2FileUploader\Entity\ImageInterface;
use Zf2FileUploader\Resource\ImageResource as GenericImageResource;
use Zf2FileUploader\Resource\ImageResourceInterface;

class ImageResource extends GenericImageResource implements ImageResourceInterface
{
    /**
     * @var ImageResource
     */
    protected $resourceEntity = null;

    public function __construct(ImageInterface $imageEntity)
    {
        $this->resourceEntity = $imageEntity;
    }

    /**
     * @return ImageInterface
     */
    public function getEntity()
    {
        return $this->resourceEntity;
    }

    /**
     * @param ImageInterface $imageEntity
     * @return ImageResourceInterface
     */
    public function setEntity(ImageInterface $imageEntity)
    {
        $this->resourceEntity = $imageEntity;
        return $this;
    }
}