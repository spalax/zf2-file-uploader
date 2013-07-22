<?php
namespace Zf2FileUploader\Resource;

interface ResourceRemovableInterface
{
    /**
     * @return mixed
     */
    public function getToken();

    /**
     * @return string
     */
    public function getPath();
}