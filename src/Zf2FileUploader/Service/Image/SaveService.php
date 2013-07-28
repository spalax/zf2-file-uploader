<?php
namespace Zf2FileUploader\Service\Image;

use Zf2FileUploader\I18n\Translator\TranslatorInterface;
use Zf2FileUploader\Resource\Handler\Decorator\ImageDecoratorInterface;
use Zf2FileUploader\Resource\ImageResourceInterface;
use Zf2FileUploader\Resource\Handler\Persister\ImagePersisterInterface;
use Zf2FileUploader\Service\Cleaner\CleanerStrategyInterface;
use Zf2FileUploader\Service\Exception\DecoratorException;
use Zf2FileUploader\Service\Exception\PersisterException;
use Zf2FileUploader\Service\Response\ImageResponse;
use Zf2FileUploader\Service\Response\ImageResponseInterface;

class SaveService implements SaveServiceInterface
{
    /**
     * @var ImagePersisterInterface
     */
    protected $persister;

    /**
     * @var TranslatorInterface
     */
    protected $translator;

    /**
     * @var ImageDecoratorInterface
     */
    protected $decorator;

    /**
     * @var CleanerStrategyInterface
     */
    protected $cleaner;

    /**
     * @param ImagePersisterInterface $persister
     * @param ImageDecoratorInterface $decorator
     * @param CleanerStrategyInterface $cleaner
     * @param TranslatorInterface $translator
     */
    public function __construct(ImagePersisterInterface $persister,
                                ImageDecoratorInterface $decorator = null,
                                CleanerStrategyInterface $cleaner,
                                TranslatorInterface $translator)
    {
        $this->persister = $persister;
        $this->decorator = $decorator;
        $this->translator = $translator;
        $this->cleaner = $cleaner;
    }

    /**
     * @param ImageResourceInterface $resource
     * @throws \Exception
     * @throws PersisterException
     * @throws DecoratorException
     */
    public function save(ImageResourceInterface $resource)
    {
        $this->cleaner->clean();

        try {
            if (!$this->persister->persist($resource)) {
                throw new PersisterException("Could not persist resource ".$resource->getToken().
                                             " with persister ".get_class($this->persister));
            }

            if (!is_null($this->decorator)) {
                if (!$this->decorator->decorate($resource)) {
                    throw new DecoratorException("Could not decorate resource ".$resource->getToken().
                                                 " with decorator ".get_class($this->decorator));
                }
            }

            $this->persister->commit();

        } catch (\Exception $e) {
            $this->persister->rollback();
            throw $e;
        }
    }
}
