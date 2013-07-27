<?php
namespace Zf2FileUploader\Resource\Persister;

use Zf2FileUploader\Resource\ImageResourceInterface;

interface ImagePersisterInterface extends PersisterInterface
{
    /**
     * @param ImageResourceInterface $resource
     * @return boolean
     */
    public function persist(ImageResourceInterface $resource);
}