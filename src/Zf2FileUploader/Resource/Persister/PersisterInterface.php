<?php
namespace Zf2FileUploader\Resource\Persister;

interface PersisterInterface
{
    /**
     * @return boolean
     */
    public function commit();

    /**
     * @return void
     */
    public function rollback();
}