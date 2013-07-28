<?php
namespace Zf2FileUploader\Service\Resource\Image;

use Zf2FileUploader\Resource\Persisted\ImageResourceInterface;
use Zf2FileUploader\Service\Resource\Exception\DomainException;
use Doctrine\ORM\EntityManager;
use Zf2FileUploader\Entity\ImageBindInterface;
use Zf2FileUploader\Options\ImageResourceOptionsInterface;

class BindService implements BindServiceInterface
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var ImageResourceOptionsInterface
     */
    protected $options;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager,
                                ImageResourceOptionsInterface $options)
    {
        $this->entityManager = $entityManager;
        $this->options = $options;
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
            $this->entityManager->persist($binder);
            if (is_null($resource->getEntity())) {
                throw new DomainException("Could not get entity from resource,
                                           resource not loaded correctly");
            }

            $binder->addImage($resource->getEntity());
            $this->entityManager->flush($binder);

            $this->entityManager->commit();
        } catch (\Exception $e) {
            $this->entityManager->rollback();
            throw $e;
        }
    }

    /**
     * @param array $resources
     * @param ImageBindInterface $binder
     */
    public function bindCollection(array $resources, ImageBindInterface $binder)
    {
        try {
            $this->entityManager->beginTransaction();
            foreach ($resources as $resource) {
                $this->bind($resource, $binder);
            }
            $this->entityManager->commit();
        } catch (\Exception $e) {
            $this->entityManager->rollback();
            throw $e;
        }
    }
}
