<?php
namespace Zf2FileUploader\Resource;

class ImageResourceFactory implements ResourceFactoryInterface
{
    /**
     * @param array $data
     * @return ResourceInterface[]
     */
    public function createResource($data)
    {
        return new ImageResource($data['tmp_name']);
    }
}