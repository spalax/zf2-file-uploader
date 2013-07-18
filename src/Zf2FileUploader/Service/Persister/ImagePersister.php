<?php
namespace Zf2FileUploader\Service\persister;

class Persister implements PersisterInterface
{
    /**
     * @var persisterInterface[]
     */
    protected $persisters = array();

    /**
     * @param PersisterInterface $persister
     * @return persister
     */
    public function addPersister(PersisterInterface $persister)
    {
        $this->persisters[] = $persister;
        return $this;
    }

    /**
     * @param ResourceInterface $resource
     * @return boolean
     */
    public function persist()
    {
        foreach ($this->persisters as $persister) {
            if (!$persister->persist()) {
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
}