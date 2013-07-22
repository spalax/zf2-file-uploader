<?php
namespace Zf2FileUploader\Resource\Persister;

class GenericPersisterStrategy extends AbstractAggregatePersister
{
    public function __construct(FilesystemPersister $fsPersister, DatabasePersister $dbPersister)
    {
        $this->persisters = array();

        $this->persisters[] = $fsPersister;
        $this->persisters[] = $dbPersister;
    }
}