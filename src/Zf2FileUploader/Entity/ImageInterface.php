<?php
namespace Zf2FileUploader\Entity;

interface ImageInterface extends ResourceInterface
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
     * @param string $httpPath
     * @return ImageInterface
     */
    public function setHttpPath($httpPath);

    /**
     * @return string
     */
    public function getHttpPath();
}