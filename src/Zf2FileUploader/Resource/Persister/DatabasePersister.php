<?php
namespace Zf2FileUploader\Resource\Persister;

use Doctrine\ORM\EntityManager;
use Zend\EventManager\Event;
use Zf2FileUploader\Entity\Resource;
use Zf2FileUploader\Resource\Persister\PersisterInterface;
use Zf2FileUploader\Resource\ResourceInterface;

class DatabasePersister extends AbstractDatabasePersister
{
    /**
     * @var Resource
     */
    protected $resourceEntity;

    public function __construct(EntityManager $entityManager, Resource $resourceEntity)
    {
        parent::__construct($entityManager);
        $this->resourceEntity = $resourceEntity;
    }

    /**
     * @param ResourceInterface $resource
     * @return boolean
     */
    public function run(ResourceInterface $resource)
    {
        $resourceEntity = clone $this->resourceEntity;

        $resourceEntity->setPath($resource->getPath());
        $resourceEntity->setToken($resource->getToken());

        $resourceEntity->setTemp(1);

        $this->entityManager->persist($resourceEntity);
        $this->entityManager->flush($resourceEntity);

        $resource->setEntity($resourceEntity);

        return true;
    }
}