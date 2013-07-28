<?php
namespace Zf2FileUploader\Input\Image;

use Zf2FileUploader\Resource\Persisted\ImageResourceInterface;

interface LoadResourceInterface
{
    /**
     * @return ImageResourceInterface[]
     */
    public function getResources();
}