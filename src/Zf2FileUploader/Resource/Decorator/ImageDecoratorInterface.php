<?php
namespace Zf2FileUploader\Resource\Decorator;

use Zf2FileUploader\Resource\ImageResourceInterface;

interface ImageDecoratorInterface extends DecoratorInterface
{
    /**
     * @param ImageResourceInterface $resource
     * @return boolean
     */
    public function decorate(ImageResourceInterface $resource);
}