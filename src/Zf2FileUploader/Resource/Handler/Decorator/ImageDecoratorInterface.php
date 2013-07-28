<?php
namespace Zf2FileUploader\Resource\Handler\Decorator;

use Zf2FileUploader\Resource\ImageResourceInterface;

interface ImageDecoratorInterface extends DecoratorInterface
{
    /**
     * @param ImageResourceInterface $resource
     * @return boolean
     */
    public function decorate(ImageResourceInterface $resource);
}