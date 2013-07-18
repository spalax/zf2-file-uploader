<?php
namespace Zf2FileUploader\Resource;

interface ResourceFactoryInterface
{
    /**
     * @param array $data
     * @return ResourceInterface[]
     */
    public function createResource($data);
}