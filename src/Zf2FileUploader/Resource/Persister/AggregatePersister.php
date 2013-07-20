<?php
namespace Zf2FileUploader\Resource\Persister;

use Zf2FileUploader\Resource\ResourceInterface;

class AggregatePersister implements PersisterInterface
{
    /**
     * @var PersisterInterface[]
     */
    protected $persisters = array();

    /**
     * @param PersisterInterface $persister
     * @return AggregatePersister
     */
    public function addPersister(PersisterInterface $persister)
    {
        \Zf2Libs\Debug\Utility::dumpAlive("addPersister=>", get_class($persister));
        $this->persisters[] = $persister;
        return $this;
    }

    /**
     * @param PersisterInterface $resource
     * @return boolean
     */
    public function persist(ResourceInterface $resource)
    {
        foreach ($this->persisters as $persister) {
            if (!$persister->persist($resource)) {
                $this->revert();
                return false;
            }
        }

        return true;
    }

    public function revert()
    {
        foreach ($this->persisters as $persister) {
            $persister->revert();
        }
    }

    public function flush()
    {
        foreach ($this->persisters as $persister) {
            if (!$persister->flush()) {
                $this->revert();
                return false;
            }
        }

        return true;
    }
}