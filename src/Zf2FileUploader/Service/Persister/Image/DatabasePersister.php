<?php
namespace Zf2FileUploader\Service\Persister\Image;

use Doctrine\ORM\EntityManager;
use Zf2FileUploader\Entity\ImageInterface;
use Zf2FileUploader\Service\Persister\PersisterInterface;

class DatabasePersister implements PersisterInterface
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var ImageInterface
     */
    protected $imageEntity;

    public function __construct(EntityManager $entityManager, ImageInterface $imageEntity)
    {
        $this->entityManager = $entityManager;
        $this->imageEntity = null;
    }

    /**
     * @param ResourceInterface $resource
     * @return boolean
     */
    public function persist()
    {
        $this->imageEntity->setAlt();
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