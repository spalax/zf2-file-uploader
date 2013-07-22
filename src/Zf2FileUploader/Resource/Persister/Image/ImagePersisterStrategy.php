<?php
namespace Zf2FileUploader\Resource\Persister\Image;

use Zf2FileUploader\Resource\Persister\AbstractAggregatePersister;

class ImagePersisterStrategy extends AbstractAggregatePersister
{
    public function __construct(FilesystemPersister $fsPersister, DatabasePersister $dbPersister)
    {
        $this->persisters = array();

        $this->persisters[] = $fsPersister;
        $this->persisters[] = $dbPersister;
    }
}