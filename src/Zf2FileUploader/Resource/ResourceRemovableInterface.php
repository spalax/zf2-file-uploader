<?php
namespace Zf2FileUploader\Resource;

interface ResourceRemovableInterface
{
    /**
     * @return mixed
     */
    public function getId();

    /**
     * @return string
     */
    public function getPath();
}