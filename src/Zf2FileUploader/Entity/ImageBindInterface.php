<?php
namespace Zf2FileUploader\Entity;

interface ImageBindInterface
{
    /**
     * @param ImageInterface $imageEntity
     */
    public function addImage(ImageInterface $imageEntity);
}