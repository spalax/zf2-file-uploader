<?php
namespace Zf2FileUploader\Resource\Handler\Processor;

use Zf2FileUploader\Resource\ImageResourceInterface;

interface ImageProcessorInterface extends ProcessorInterface
{
    /**
     * @param ImageResourceInterface $resource
     * @return boolean
     */
    public function process(ImageResourceInterface $resource);
}