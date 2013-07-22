<?php
namespace Zf2FileUploader\Entity;

interface ImageInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @return string
     */
    public function getAlt();

    /**
     * @param string $alt
     * @return ImageInterface
     */
    public function setAlt($alt);

    /**
     * @param Resource $resource
     * @return ImageInterface
     */
    public function setResource(Resource $resource);

    /**
     * @param string $httpPath
     * @return ImageInterface
     */
    public function setHttpPath($httpPath);

    /**
     * @return string
     */
    public function getHttpPath();
}