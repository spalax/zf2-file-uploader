<?php
namespace Zf2FileUploader\Input\Image;

use Zf2FileUploader\Resource\ImageResourceInterface;

interface CreateResourceInterface
{
    /**
     * @return mixed
     */
    public function getValue();

    /**
     * @return ImageResourceInterface[]
     */
    public function getResources();
}
