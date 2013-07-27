<?php
namespace Zf2FileUploader\InputData;

use Zf2FileUploader\Resource\ImageResourceInterface;

interface ImageResourceDataInterface extends ResourceDataInterface
{
    /**
     * @return ImageResourceInterface[]
     */
    public function getResources();
}