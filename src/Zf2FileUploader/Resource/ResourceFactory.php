<?php
namespace Zf2FileUploader\Resource;

class ResourceFactory implements ResourceFactoryInterface
{
    /**
     * @param array $data
     * @return ResourceInterface[]
     */
    public function createResource($data)
    {
        return new Resource($data['tmp_name']);
    }
}