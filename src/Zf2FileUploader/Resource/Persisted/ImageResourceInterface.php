<?php
namespace Zf2FileUploader\Resource\Persisted;

use Zf2FileUploader\Entity\ImageInterface;
use Zf2FileUploader\Resource\ImageResourceInterface as GenericImageResourceInterface;

interface ImageResourceInterface extends GenericImageResourceInterface
{
    /**
     * @return ImageInterface
     */
    public function getEntity();

    /**
     * @param ImageInterface $imageEntity
     * @return ImageResourceInterface
     */
    public function setEntity(ImageInterface $imageEntity);
}