<?php
namespace Zf2FileUploader\Resource\Persister;

abstract class AbstractAggregatePersister implements PersisterInterface
{
    /**
     * @return PersisterInterface[]
     */
    abstract protected function getPersisted();

    public function commit()
    {
        foreach ($this->getPersisted() as $persister) {
            if (!$persister->commit()) {
                return false;
            }
        }
        return true;
    }

    public function rollback()
    {
        /* @var $persister PersisterInterface */
        foreach (array_reverse($this->getPersisted()) as $persister) {
            $persister->rollback();
        }
    }
}