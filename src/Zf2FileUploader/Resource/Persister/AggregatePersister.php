<?php
namespace Zf2FileUploader\Resource\Persister;

class AggregatePersister extends AbstractAggregatePersister
{
    /**
     * @param PersisterInterface $persister
     * @return AggregatePersister
     */
    public function addPersister(PersisterInterface $persister)
    {
        $this->persisters[] = $persister;
        return $this;
    }
}