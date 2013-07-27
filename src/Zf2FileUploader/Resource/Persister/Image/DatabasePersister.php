<?php
namespace Zf2FileUploader\Resource\Persister\Image;

use Doctrine\ORM\EntityManager;
use Zf2FileUploader\Entity\ImageInterface;
use Zf2FileUploader\Resource\ImageResourceInterface;
use Zf2FileUploader\Resource\Persister\AbstractDatabasePersister;
use Zf2FileUploader\Resource\Persister\ImagePersisterInterface;

class DatabasePersister extends AbstractDatabasePersister implements ImagePersisterInterface
{
    /**
     * @var ImageInterface
     */
    protected $imageResourceEntity;

    public function __construct(EntityManager $entityManager,
                                ImageInterface $imageResourceEntity)
    {
        parent::__construct($entityManager);
        $this->imageResourceEntity = $imageResourceEntity;
    }

    /**
     * @param ImageResourceInterface $resource
     * @return boolean
     */
    public function persist(ImageResourceInterface $resource)
    {
        $imageResourceEntity = clone $this->imageResourceEntity;

        $imageResourceEntity->setPath($resource->getPath());
        $imageResourceEntity->setHttpPath($resource->getHttpPath());
        $imageResourceEntity->setToken($resource->getToken());

        $imageResourceEntity->setTemporary(1);

        $this->entityManager->beginTransaction();

        $this->entityManager->persist($imageResourceEntity);
        $this->entityManager->flush($imageResourceEntity);

        $resource->setEntity($imageResourceEntity);

        return true;
    }
}