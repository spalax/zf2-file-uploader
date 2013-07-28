<?php
namespace Zf2FileUploader\Service\Image;

use Zf2FileUploader\Resource\Persisted\ImageResourceInterface;
use Zf2FileUploader\Service\Exception\DomainException;
use Doctrine\ORM\EntityManager;
use Zf2FileUploader\Entity\ImageBindInterface;

class BindService implements BindServiceInterface
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param ImageResourceInterface $resource
     * @param ImageBindInterface $binder
     * @throws DomainException
     */
    public function bind(ImageResourceInterface $resource, ImageBindInterface $binder)
    {
        try {
            $this->entityManager->beginTransaction();
            $imageEntity = $resource->getEntity();

            $this->entityManager->persist($imageEntity);
            $this->entityManager->persist($binder);
            if (is_null($resource->getEntity())) {
                throw new DomainException("Could not get entity from resource,
                                           resource not loaded correctly");
            }

            $imageEntity->setTemporary(false);

            $binder->addImage($imageEntity);

            $this->entityManager->flush($binder);
            $this->entityManager->flush($imageEntity);

            $this->entityManager->commit();
        } catch (\Exception $e) {
            $this->entityManager->rollback();
            throw $e;
        }
    }
}
