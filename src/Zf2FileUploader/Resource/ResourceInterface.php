<?php
namespace Zf2FileUploader\Resource;

interface ResourceInterface
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