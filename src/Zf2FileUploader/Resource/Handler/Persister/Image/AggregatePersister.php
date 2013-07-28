<?php
namespace Zf2FileUploader\Resource\Handler\Persister\Image;

use Zf2FileUploader\Resource\ImageResourceInterface;
use Zf2FileUploader\Resource\Handler\Persister\AbstractAggregatePersister;
use Zf2FileUploader\Resource\Handler\Persister\ImagePersisterInterface;

class AggregatePersister extends AbstractAggregatePersister implements ImagePersisterInterface
{
    /**
     * @var ImagePersisterInterface[]
     */
    protected $persisters = array();

    /**
     * @var ImagePersisterInterface[]
     */
    protected $persisted = array();

    /**
     * @param ImagePersisterInterface $persister
     * @return AggregatePersister
     */
    public function addPersister(ImagePersisterInterface $persister)
    {
        $this->persisters[] = $persister;
        return $this;
    }

    /**
     * @param ImageResourceInterface $resource
     * @return boolean
     */
    public function persist(ImageResourceInterface $resource)
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

    /**
     * @return ImagePersisterInterface[]
     */
    protected function getPersisted()
    {
        return $this->persisted;
    }
}