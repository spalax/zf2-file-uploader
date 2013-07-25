<?php
namespace Zf2FileUploader\Resource;

interface ResourceViewableInterface
{
    /**
     * @return mixed
     */
    public function getToken();

    /**
     * @return string
     */
    public function getHttpPath();

    /**
     * @param string $httpPath
     * @return string
     */
    public function setHttpPath($httpPath);
}