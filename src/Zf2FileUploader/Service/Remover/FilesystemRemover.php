<?php
namespace Zf2FileUploader\Service\Remover;

use Zf2FileUploader\Entity\ResourceInterface;

class FilesystemRemover implements RemoverInterface
{
    /**
     * @param ResourceInterface $resource
     * @return boolean
     */
    public function remove(ResourceInterface $resource)
    {
        if (!file_exists($resource->getPath())) {
            return false;
        }

        if (!is_writable($resource->getPath())) {
            return false;
        }

        $result = unlink($resource->getPath());
        return $result;
    }
}
