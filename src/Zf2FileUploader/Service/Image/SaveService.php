<?php
namespace Zf2FileUploader\Service\Image;

use Zf2FileUploader\Resource\Handler\Processor\ImageProcessorInterface;
use Zf2FileUploader\Resource\ImageResourceInterface;
use Zf2FileUploader\Resource\Handler\Persister\ImagePersisterInterface;
use Zf2FileUploader\Service\Cleaner\CleanerStrategyInterface;
use Zf2FileUploader\Service\Exception\ProcessorException;
use Zf2FileUploader\Service\Exception\PersisterException;

class SaveService implements SaveServiceInterface
{
    /**
     * @var ImagePersisterInterface
     */
    protected $persister;

    /**
     * @var ImageProcessorInterface
     */
    protected $processor;

    /**
     * @var CleanerStrategyInterface
     */
    protected $cleaner;

    /**
     * @param ImagePersisterInterface $persister
     * @param ImageProcessorInterface $processor
     * @param CleanerStrategyInterface $cleaner
     */
    public function __construct(ImagePersisterInterface $persister,
                                ImageProcessorInterface $processor = null,
                                CleanerStrategyInterface $cleaner)
    {
        $this->persister = $persister;
        $this->processor = $processor;
        $this->cleaner = $cleaner;
    }

    /**
     * @param ImageResourceInterface $resource
     * @throws \Exception
     * @throws PersisterException
     * @throws ProcessorException
     */
    public function save(ImageResourceInterface $resource)
    {
        $this->cleaner->clean();

        try {
            if (!$this->persister->persist($resource)) {
                throw new PersisterException("Could not persist resource ".$resource->getToken().
                                             " with persister ".get_class($this->persister));
            }

            if (!is_null($this->processor)) {
                if (!$this->processor->process($resource)) {
                    throw new ProcessorException("Could not process resource ".$resource->getToken().
                                                 " with processor ".get_class($this->processor));
                }
            }

            $this->persister->commit();

        } catch (\Exception $e) {
            $this->persister->rollback();
            throw $e;
        }
    }
}
