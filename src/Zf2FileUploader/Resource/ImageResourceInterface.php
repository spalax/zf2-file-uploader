<?php
namespace Zf2FileUploader\Resource;

use Zf2FileUploader\Entity\ImageInterface;

interface ImageResourceInterface extends ResourceInterface, ResourceViewableInterface
{
    /**
     * @return ImageInterface | null
     */
    public function getEntity();

    /**
     * @param ImageInterface $imageEntity
     * @return ImageResourceInterface
     */
    public function setEntity(ImageInterface $imageEntity);
}