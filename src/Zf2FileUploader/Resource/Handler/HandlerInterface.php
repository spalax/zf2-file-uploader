<?php
namespace Zf2FileUploader\Resource\Handler;

use Zf2FileUploader\Resource\ResourceInterface;

interface HandlerInterface
{
    /**
     * @param ResourceInterface $resource
     * @return boolean
     */
    public function handle(ResourceInterface $resource);
}