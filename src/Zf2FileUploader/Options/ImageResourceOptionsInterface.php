<?php
namespace Zf2FileUploader\Options;

interface ImageResourceOptionsInterface
{
    /**
     * @return string
     */
    public function getImagePersistentPath();

    /**
     * @return string
     */
    public function getImageEntityClass();

    /**
     * @return string
     */
    public function getImageHttpPath();
}
