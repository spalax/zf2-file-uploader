<?php
namespace Zf2FileUploader\Resource\Persister\Image;

use Doctrine\ORM\EntityManager;
use Zf2FileUploader\Entity\ImageInterface;
use Zf2FileUploader\Resource\Persister\AbstractDatabasePersister;
use Zf2FileUploader\Resource\ResourceInterface;
use Zf2FileUploader\Resource\Resource;
use Zf2FileUploader\Entity\Resource as ResourceEntity;

class DatabasePersister extends AbstractDatabasePersister
{
    /**
     * @var ImageInterface
     */
    protected $imageEntity;

    public function __construct(EntityManager $entityManager,
                                ImageInterface $imageEntity)
    {
        parent::__construct($entityManager);
        $this->imageEntity = $imageEntity;
    }

    /**
     * @param Resource $resource
     * @return ResourceEntity | null
     */
    protected function getResourceEntity(Resource $resource)
    {
        if (is_null($resourceEntity = $resource->getEntity()) ||
            is_null($resourceEntity = $this->entityManager->getRepository('Zf2FileUploader\Entity\Resource')
                                           ->findOneByToken($resource->getToken()))) {
            return null;
        }

        $resource->setEntity($resourceEntity);
        return $resourceEntity;
    }

    /**
     * @param ResourceInterface $resource
     * @return boolean
     */
    protected function run(ResourceInterface $resource)
    {
        if (is_null($resourceEntity = $this->getResourceEntity($resource))) {
            return false;
        }

        $imageEntity = clone $this->imageEntity;

        $imageEntity->setResource($resourceEntity);
        $resourceEntity->setTemp(0);

        $this->entityManager->persist($resourceEntity);
        $this->entityManager->persist($imageEntity);

        $this->entityManager->flush($resourceEntity);
        $this->entityManager->flush($imageEntity);

        return true;
    }
}