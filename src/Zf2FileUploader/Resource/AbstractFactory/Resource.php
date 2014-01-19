<?php
namespace Zf2FileUploader\Resource\AbstractFactory;

use Zf2FileUploader\Resource\ImageResource;
use Zf2FileUploader\Resource\ImageResourceInterface;
use Zf2Libs\Filter\File\ExtensionExtractor;

class Resource implements ResourceInterface
{
    /**
     * @param array $data
     * @return ImageResourceInterface
     */
    public function createImageResource($data)
    {
        $filter = new ExtensionExtractor();
        $ext = $filter->filter($data['tmp_name']);

        return new ImageResource($data['tmp_name'], $ext);
    }
}
