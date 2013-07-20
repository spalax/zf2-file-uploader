<?php
namespace Zf2FileUploader\Resource\Remover;

use Doctrine\ORM\EntityManager;
use Zf2FileUploader\Resource\ResourceInterface;

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
            $this->entityManager->remove($this->entityManager
                                              ->getReference('Zf2FileUploader\Entity\Resource',
                                                             $resource->getId()));
        } catch (\Exception $e) {
            return false;
        }
        return true;
    }
}
