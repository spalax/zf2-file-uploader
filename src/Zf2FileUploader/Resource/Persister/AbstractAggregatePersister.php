<?php
namespace Zf2FileUploader\Resource\Persister;

use Zf2FileUploader\Resource\ResourceInterface;

abstract class AbstractAggregatePersister implements PersisterInterface
{
    /**
     * @var PersisterInterface[]
     */
    protected $persisters = array();

    /**
     * @var PersisterInterface[]
     */
    protected $persisted = array();

    /**
     * @param PersisterInterface $resource
     * @return boolean
     */
    public function persist(ResourceInterface $resource)
    {
        $this->persisted = array();

        foreach ($this->persisters as $persister) {
            $result = $persister->persist($resource);
            $this->persisted[] = $persister;
            if (!$result) {
                return false;
            }
        }
        return true;
    }

    public function commit()
    {
        foreach ($this->persisted as $persister) {
            if (!$persister->commit()) {
                return false;
            }
        }
        return true;
    }

    public function rollback()
    {
        foreach (array_reverse($this->persisted) as $persister) {
            $persister->rollback();
        }
    }
}