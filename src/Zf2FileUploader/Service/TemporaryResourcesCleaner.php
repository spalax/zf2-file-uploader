<?php
namespace Zf2FileUploader\Service;

use Doctrine\ORM\EntityManager;
use Zf2FileUploader\Options\TemporaryCleanerOptionsInterface;
use Zf2FileUploader\Service\Remover\RemoverInterface;

class TemporaryResourcesCleaner
{
    /**
     * @var EntityManager
     */
    protected $entityManager = null;

    /**
     * @var TemporaryCleanerOptionsInterface
     */
    protected $options = null;

    /**
     * @var RemoverInterface
     */
    protected $remover = null;

    /**
     * @param EntityManager $entityManager
     * @param TemporaryCleanerOptionsInterface $options
     * @param RemoverInterface $remover
     */
    public function __construct(EntityManager $entityManager,
                                TemporaryCleanerOptionsInterface $options,
                                RemoverInterface $remover)
    {
        $this->entityManager = $entityManager;
        $this->options = $options;
        $this->remover = $remover;
    }

    /**
     * @return bool
     */
    public function clean()
    {
        $repository = $this->entityManager->getRepository('Zf2FileUploader\Entity\Resource');
        $qb = $repository->createQueryBuilder('res');

        $date = new \DateTime();
        $dateInterval = new \DateInterval('PT'.$this->options->getTtl().'S');
        $date->sub($dateInterval);

        $result = $qb->where($qb->expr()->lt('createdTimestamp', $date))
                     ->andWhere($qb->expr()->eq('temporary', '1'))
                     ->getQuery()->getResult();

        foreach ($result as $resource) {
            if (!$this->remover->remove($resource)) {
                return false;
            }
        }

        return true;
    }
}
