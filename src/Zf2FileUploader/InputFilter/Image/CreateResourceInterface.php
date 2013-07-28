<?php
namespace Zf2FileUploader\InputFilter\Image;

use Zf2FileUploader\Resource\ImageResourceInterface;

interface CreateResourceInterface
{
    /**
     * @return ImageResourceInterface[]
     */
    public function getResources();
}