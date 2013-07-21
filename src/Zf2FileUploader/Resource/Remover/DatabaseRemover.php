<?php
namespace Zf2FileUploader\Resource\Remover;

use Doctrine\ORM\EntityManager;
use Zf2FileUploader\Entity\Resource;
use Zf2FileUploader\Resource\ResourceRemovableInterface;

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
     * @param ResourceRemovableInterface $resource
     * @return boolean
     */
    public function remove(ResourceRemovableInterface $resource)
    {
        try {
            $entity = null;
            if ($resource instanceof Resource) {
                $entity = $resource;
            } else {
                $entity = $this->entityManager->getRepository('Zf2FileUploader\Entity\Resource')
                               ->findOneByToken($resource->getId());

                if (is_null($entity)) {
                    return false;
                }
            }

            $this->entityManager->remove($entity);
            $this->entityManager->flush($entity);
        } catch (\Exception $e) {
            return false;
        }
        return true;
    }
}
