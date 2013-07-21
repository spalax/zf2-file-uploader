<?php
namespace Zf2FileUploader\Resource\Persister;

use Zf2FileUploader\Resource\ResourceInterface;

interface PersisterInterface
{
    /**
     * @param ResourceInterface $resource
     * @return boolean
     */
    public function persist(ResourceInterface $resource);

    /**
     * @return boolean
     */
    public function commit();

    public function rollback();
}