<?php
namespace Zf2FileUploader\Resource\Handler\Persister;

use Doctrine\ORM\EntityManager;
use Zf2FileUploader\Resource\Handler\Persister\PersisterInterface;

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