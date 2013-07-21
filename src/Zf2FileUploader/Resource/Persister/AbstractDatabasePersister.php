<?php
namespace Zf2FileUploader\Resource\Persister;

use Doctrine\ORM\EntityManager;
use Zf2FileUploader\Resource\Persister\PersisterInterface;
use Zf2FileUploader\Resource\ResourceInterface;

abstract class AbstractDatabasePersister implements PersisterInterface
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param ResourceInterface $resource
     * @return boolean
     */
    public function persist(ResourceInterface $resource)
    {
        $this->entityManager->beginTransaction();
        return $this->run($resource);
    }

    /**
     * @param ResourceInterface $resource
     * @return mixed
     */
    abstract protected function run(ResourceInterface $resource);

    public function commit()
    {
        $this->entityManager->commit();
        return true;
    }

    public function rollback()
    {
        $this->entityManager->rollback();
    }
}