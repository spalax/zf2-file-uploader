<?php
namespace Zf2FileUploader\Service\Remover;

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
    public function remove(ResourceInterface $resource)
    {
        try {
            $this->entityManager->remove($resource);
        } catch (\Exception $e) {
            return false;
        }
        return true;
    }
}
