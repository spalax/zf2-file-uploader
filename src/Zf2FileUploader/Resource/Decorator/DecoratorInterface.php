<?php
namespace Zf2FileUploader\Resource\Decorator;

use Zf2FileUploader\Resource\ResourceInterface;

interface DecoratorInterface
{
    /**
     * @param ResourceInterface $resource
     * @return boolean
     */
    public function decorate(ResourceInterface $resource);
}