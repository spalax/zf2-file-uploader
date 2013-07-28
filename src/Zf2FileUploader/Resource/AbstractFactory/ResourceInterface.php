<?php
namespace Zf2FileUploader\Resource\AbstractFactory;

use Zf2FileUploader\Resource\ImageResourceInterface;

interface ResourceInterface
{
    /**
     * @param array $data
     * @return ImageResourceInterface[]
     */
    public function createImageResource($data);
}