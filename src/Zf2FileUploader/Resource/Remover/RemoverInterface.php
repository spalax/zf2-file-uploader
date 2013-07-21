<?php
namespace Zf2FileUploader\Resource\Remover;

use Zf2FileUploader\Resource\ResourceRemovableInterface;

interface RemoverInterface
{
    /**
     * @param ResourceRemovableInterface $resource
     * @return boolean
     */
    public function remove(ResourceRemovableInterface $resource);
}