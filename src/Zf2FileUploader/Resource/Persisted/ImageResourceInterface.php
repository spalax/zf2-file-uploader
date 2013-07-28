<?php
namespace Zf2FileUploader\Resource\Persisted;

use Zf2FileUploader\Entity\ImageInterface;

interface ImageResourceInterface
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