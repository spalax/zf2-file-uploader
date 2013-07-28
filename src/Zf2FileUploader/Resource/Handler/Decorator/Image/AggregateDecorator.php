<?php
namespace Zf2FileUploader\Resource\Handler\Decorator\Image;

use Zf2FileUploader\Resource\Handler\Decorator\ImageDecoratorInterface;
use Zf2FileUploader\Resource\ImageResourceInterface;

class AggregateDecorator implements ImageDecoratorInterface
{
    /**
     * @var ImageDecoratorInterface[]
     */
    protected $decorators = array();

    /**
     * @param ImageDecoratorInterface $decorator
     * @return AggregateDecorator
     */
    public function addDecorator(ImageDecoratorInterface $decorator)
    {
        $this->decorators[] = $decorator;
        return $this;
    }

    /**
     * @param ImageResourceInterface $resource
     * @return boolean
     */
    public function decorate(ImageResourceInterface $resource)
    {
        foreach ($this->decorators as $decorator) {
            if (!$decorator->decorate($resource)) {
                return false;
            }
        }

        return true;
    }
}