<?php
namespace Zf2FileUploader\Resource;

interface AbstractResourceFactoryInterface
{
    /**
     * @param array $data
     * @return ImageResourceInterface[]
     */
    public function createImageResource($data);
}