<?php
namespace Zf2FileUploader\Resource\Handler\Processor\Image;

use Zf2FileUploader\Resource\Handler\Processor\ImageProcessorInterface;
use Zf2FileUploader\Resource\ImageResourceInterface;

class AggregateProcessor implements ImageProcessorInterface
{
    /**
     * @var ImageProcessorInterface[]
     */
    protected $processors = array();

    /**
     * @param ImageProcessorInterface $processor
     * @return AggregateProcessor
     */
    public function addProcessor(ImageProcessorInterface $processor)
    {
        $this->processors[] = $processor;
        return $this;
    }

    /**
     * @param ImageResourceInterface $resource
     * @return boolean
     */
    public function process(ImageResourceInterface $resource)
    {
        foreach ($this->processors as $processor) {
            if (!$processor->process($resource)) {
                return false;
            }
        }

        return true;
    }
}