<?php
namespace Zf2FileUploader\Resource\Remover;

use Zf2FileUploader\Resource\ResourceRemovableInterface;

class ThumbnailsRemover implements RemoverInterface
{
    /**
     * @param ResourceRemovableInterface $resource
     * @return boolean
     */
    public function remove(ResourceRemovableInterface $resource)
    {
        $result = true;

        $directory = new \DirectoryIterator(dirname($resource->getPath()));
        /* @var $file \DirectoryIterator */
        foreach ($directory as $file) {
            if ($file->isDir()) continue;
            if (preg_match('/.*\_[0-9]+x[0-9]+.*/', $file->getBasename())) {
                if (!unlink($file->getRealPath())) {
                    $result = false;
                }
            }
        }

        return $result;
    }
}
