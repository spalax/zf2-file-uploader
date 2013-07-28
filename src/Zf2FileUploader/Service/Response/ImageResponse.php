<?php
namespace Zf2FileUploader\Service\Response;

use Zf2FileUploader\Resource\ImageResourceInterface;

class ImageResponse extends AbstractResponse implements ImageResponseInterface
{
    /**
     * @var ImageResourceInterface
     */
    protected $resource;

    public function __construct(ImageResourceInterface $resource)
    {
        $this->resource = $resource;
    }

    /**
     * @return ImageResourceInterface
     */
    public function getResource()
    {
       return $this->resource;
    }
}