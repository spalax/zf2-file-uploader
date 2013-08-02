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
     * @param ResourceInterface $resource
     * @return boolean
     */
    public function remove(ResourceInterface $entity)
    {
        try {
            $this->entityManager->persist($entity);
            $this->entityManager->remove($entity);
            $this->entityManager->flush($entity);
        } catch (\Exception $e) {
            return false;
        }
        return true;
    }
}
