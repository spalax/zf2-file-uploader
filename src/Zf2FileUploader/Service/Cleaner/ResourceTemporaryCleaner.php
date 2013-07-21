<?php
namespace Zf2FileUploader\Service\Cleaner;

use Doctrine\ORM\EntityManager;
use Zf2FileUploader\Options\TemporaryCleanerOptionsInterface;
use Zf2FileUploader\Resource\Remover\RemoverInterface;

class ResourceTemporaryCleaner implements CleanerStrategyInterface
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

        $query = $qb->where('res.createdTimestamp < :timestamp')
                    ->andWhere($qb->expr()->eq('res.temp', '1'))
                    ->setParameter('timestamp', $date)->getQuery();

        $response = true;
        foreach ($query->getResult() as $resource) {
            if (!$this->remover->remove($resource)) {
                $response = false;
            }
        }

        return $response;
    }
}
