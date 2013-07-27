<?php
namespace Zf2FileUploader\Resource;

use Zf2Libs\Filter\File\ExtensionExtractor;

class AbstractResourceFactory implements AbstractResourceFactoryInterface
{
    /**
     * @param array $data
     * @return ImageResourceInterface[]
     */
    public function createImageResource($data)
    {
        $filter = new ExtensionExtractor();
        $ext = $filter->filter($data['tmp_name']);

        return new ImageResource($data['tmp_name'], $ext);
    }
}