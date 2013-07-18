<?php
namespace Zf2FileUploader\Service\Persister\Image;

use Doctrine\ORM\EntityManager;
use Zf2FileUploader\Entity\ImageInterface;
use Zf2FileUploader\Entity\ResourceInterface;
use Zf2FileUploader\Service\Persister\PersisterInterface;

class DatabasePersister implements PersisterInterface
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var ResourceInterface
     */
    protected $resourceEntity;

    public function __construct(EntityManager $entityManager, ResourceInterface $resourceEntity)
    {
        $this->entityManager = $entityManager;
        $this->resourceEntity = null;
    }

    /**
     * @param ResourceInterface $resource
     * @return boolean
     */
    public function persist()
    {
        $this->resourceEntity->setPath();
        $this->entityManager->persist();
        return true;
    }

    public function revert()
    {
        foreach ($this->persisters as $persister) {
            $persister->revert();
        }
    }
}