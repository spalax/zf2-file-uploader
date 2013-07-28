<?php
namespace Zf2FileUploader\Resource;

class ImageResource extends AbstractResource implements ImageResourceInterface
{
    /**
     * @var string
     */
    protected $httpPath = '';

    /**
     * @param string $httpPath
     * @return ImageResource
     */
    public function setHttpPath($httpPath)
    {
        $this->httpPath = $httpPath;
        return $this;
    }

    /**
     * @return string
     */
    public function getHttpPath()
    {
        return $this->httpPath;
    }
}