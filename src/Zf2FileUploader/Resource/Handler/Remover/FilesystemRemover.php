<?php
namespace Zf2FileUploader\Resource\Handler\Remover;

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

        $result = true;

        $directory = new \DirectoryIterator(dirname($resource->getPath()));

        /* @var $file \DirectoryIterator */
        foreach ($directory as $file) {
            if ($file->isDir()) continue;
            if (preg_match('/^'.$resource->getToken().'.+/', $file->getBasename())) {
                if (!unlink($file->getRealPath())) {
                    $result = false;
                }
            }
        }

        if (!unlink($resource->getPath())) {
            return false;
        }

        return $result;
    }
}
