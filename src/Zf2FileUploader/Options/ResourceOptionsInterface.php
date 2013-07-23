<?php
namespace Zf2FileUploader\Options;

interface ResourceOptionsInterface
{
    /**
     * @return string
     */
    public function getResourcePersistentPath();

    /**
     * @return string
     */
    public function getResourceHttpPath();
}
