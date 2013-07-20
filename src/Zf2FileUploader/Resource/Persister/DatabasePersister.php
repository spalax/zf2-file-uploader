<?php
namespace Zf2FileUploader\Resource\Persister;

use Doctrine\ORM\EntityManager;
use Zf2FileUploader\Entity\Resource;
use Zf2FileUploader\Resource\Persister\PersisterInterface;
use Zf2FileUploader\Resource\ResourceInterface;

class DatabasePersister implements PersisterInterface
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var Resource
     */
    protected $resourceEntity;

    public function __construct(EntityManager $entityManager, Resource $resourceEntity)
    {
        $this->entityManager = $entityManager;
        $this->resourceEntity = $resourceEntity;
    }

    /**
     * @param ResourceInterface $resource
     * @return boolean
     */
    public function persist(ResourceInterface $resource)
    {
        $this->resourceEntity->setPath($resource->getPath());
        $this->entityManager->persist($this->resourceEntity);
        $this->entityManager->flush($this->resourceEntity);
        return true;
    }

    public function revert()
    {
        //$this->entityManager->
//        $this->entityManager->clear($this->resourceEntity);
    }
}