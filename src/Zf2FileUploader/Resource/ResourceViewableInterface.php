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
     * @param string $httpPath
     * @return ResourceViewableInterface
     */
    public function setHttpPath($httpPath);
}