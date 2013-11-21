<?php
namespace Zf2FileUploader\Service\Cleaner;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Zf2FileUploader\Options\ImageResourceOptionsInterface;
use Zf2FileUploader\Options\TemporaryCleanerOptionsInterface;
use Zf2FileUploader\Resource\Handler\Remover\RemoverInterface;

class ImageTemporaryCleaner extends ResourceTemporaryCleaner implements CleanerStrategyInterface
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var ImageResourceOptionsInterface
     */
    protected $imageOptions;

    /**
     * @param EntityManager $entityManager
     * @param \Zf2FileUploader\Options\TemporaryCleanerOptionsInterface $temporaryOptions
     * @param \Zf2FileUploader\Options\ImageResourceOptionsInterface $imageOptions
     * @param RemoverInterface $remover
     */
    public function __construct(EntityManager $entityManager,
                                TemporaryCleanerOptionsInterface $temporaryOptions,
                                ImageResourceOptionsInterface $imageOptions,
                                RemoverInterface $remover)
    {
        $this->entityManager = $entityManager;
        $this->imageOptions = $imageOptions;
        parent::__construct($temporaryOptions, $remover);
    }

    /**
     * @return EntityRepository
     */
    protected function getRepository()
    {
        return $this->entityManager
                    ->getRepository($this->imageOptions
                                         ->getImageEntityClass());
    }
}
