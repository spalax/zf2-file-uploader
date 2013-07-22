<?php
namespace Zf2FileUploader\Resource;

use Zf2Libs\Filter\File\ExtensionExtractor;

class ResourceFactory implements ResourceFactoryInterface
{

    /**
     * @param array $data
     * @return ResourceInterface[]
     */
    public function createResource($data)
    {
        $filter = new ExtensionExtractor();
        $ext = $filter->filter($data['tmp_name']);

        return new Resource($data['tmp_name'], $ext);
    }
}