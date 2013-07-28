<?php
namespace Zf2FileUploader\Resource\AbstractFactory;

use Doctrine\ORM\EntityManager;
use Zf2FileUploader\Options\ImageResourceOptionsInterface;
use Zf2FileUploader\Resource\Persisted\ImageResource;

class PersistedResource implements PersistedResourceInterface
{
    protected $imageRepository = null;

    public function __construct(EntityManager $entityManager, ImageResourceOptionsInterface $imageOptions)
    {
        $this->imageRepository = $entityManager->getRepository($imageOptions->getImageEntityClass());
    }

    /**
     * @param array $data
     * @return ImageResource | null
     */
    public function loadImageResource($token)
    {
        $entity = $this->imageRepository->findOneByToken($token);
        if (!$entity) {
            return null;
        }
        return new ImageResource($entity);
    }
}