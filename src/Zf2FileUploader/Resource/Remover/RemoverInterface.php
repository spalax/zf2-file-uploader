<?php
namespace Zf2FileUploader\Resource\Remover;

use Zf2FileUploader\Entity\ResourceInterface;

interface RemoverInterface
{
    /**
     * @param ResourceInterface $resource
     * @return boolean
     */
    public function remove(ResourceInterface $resource);
}