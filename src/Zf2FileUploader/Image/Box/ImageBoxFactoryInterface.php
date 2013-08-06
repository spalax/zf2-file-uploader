<?php
namespace Zf2FileUploader\Image\Box;

use Imagine\Image\Box;

interface ImageBoxFactoryInterface
{
    /**
     * @param string | array $data
     * @return Box
     */
    public function getImageBox($data);
}