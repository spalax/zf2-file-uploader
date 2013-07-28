<?php
namespace Zf2FileUploader\Resource\Handler\Persister;

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