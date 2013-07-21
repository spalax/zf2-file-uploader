<?php
namespace Zf2FileUploader\Resource\Remover;

use Zf2FileUploader\Resource\ResourceRemovableInterface;

class FilesystemRemover implements RemoverInterface
{
    /**
     * @param ResourceRemovableInterface $resource
     * @return boolean
     */
    public function remove(ResourceRemovableInterface $resource)
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
