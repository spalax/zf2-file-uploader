<?php
namespace Zf2FileUploader\Resource\Persisted;

use Zf2FileUploader\Entity\ImageInterface;
use Zf2FileUploader\Resource\ImageResource as GenericImageResource;
use Zf2FileUploader\Resource\Persisted\ImageResourceInterface;

class ImageResource extends GenericImageResource implements ImageResourceInterface
{
    /**
     * @var ImageResource
     */
    protected $resourceEntity = null;

    public function __construct(ImageInterface $imageEntity)
    {
        $this->resourceEntity = $imageEntity;

        $this->setPath($imageEntity->getPath());
        $this->setHttpPath($imageEntity->getHttpPath());
        $this->setToken($imageEntity->getToken());

        $info = pathinfo($imageEntity->getPath());
        $this->setExt($info['extension']);
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