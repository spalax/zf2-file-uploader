<?php
namespace Zf2FileUploader\Input\Image;

use Zf2FileUploader\Resource\ImageResourceInterface;

interface CreateResourceInterface
{
    /**
     * @return ImageResourceInterface[]
     */
    public function getValue();
}