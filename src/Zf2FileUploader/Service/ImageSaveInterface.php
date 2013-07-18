<?php
namespace Front\Service\Upload;

use Front\Data\Upload\ImageInterface;
interface ImageSaveInterface
{
    /**
     * @param ImageInterface $uploadData
     * @return string
     */
    public function save(ImageInterface $uploadData);
}
