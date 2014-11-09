<?php
namespace Zf2FileUploader\Resource\Handler\Remover;

use Doctrine\ORM\EntityManager;
use Zf2FileUploader\Entity\ResourceInterface;

class DatabaseRemover implements RemoverInterface
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param \Zf2FileUploader\Entity\ResourceInterface $entity
     * @return boolean
     */
    public function remove(ResourceInterface $entity)
    {
        $this->entityManager->remove($entity);
        $this->entityManager->flush($entity);
        return true;
    }
}
