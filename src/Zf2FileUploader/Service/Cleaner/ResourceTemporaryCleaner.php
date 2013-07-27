<?php
namespace Zf2FileUploader\Service\Cleaner;

use Doctrine\ORM\EntityRepository;
use Zf2FileUploader\Options\TemporaryCleanerOptionsInterface;
use Zf2FileUploader\Resource\Remover\RemoverInterface;

abstract class ResourceTemporaryCleaner implements CleanerStrategyInterface
{
    /**
     * @var TemporaryCleanerOptionsInterface
     */
    protected $options;

    /**
     * @var RemoverInterface
     */
    protected $remover;

    /**
     * @param TemporaryCleanerOptionsInterface $options
     * @param RemoverInterface $remover
     */
    public function __construct(TemporaryCleanerOptionsInterface $options,
                                RemoverInterface $remover)
    {
        $this->options = $options;
        $this->remover = $remover;
    }

    /**
     * @return EntityRepository
     */
    abstract protected function getRepository();

    /**
     * @return bool
     */
    public function clean()
    {
        $qb = $this->getRepository()->createQueryBuilder('r');

        $date = new \DateTime();
        $dateInterval = new \DateInterval('PT'.$this->options->getTtl().'S');
        $date->sub($dateInterval);

        $query = $qb->where('r.createdTimestamp < :timestamp')
                    ->andWhere($qb->expr()->eq('r.temporary', '1'))
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
