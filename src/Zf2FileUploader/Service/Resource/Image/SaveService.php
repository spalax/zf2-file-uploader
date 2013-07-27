<?php
namespace Zf2FileUploader\Service\Resource\Image;

use Zf2FileUploader\I18n\Translator\TranslatorInterface;
use Zf2FileUploader\Resource\ImageResourceInterface;
use Zf2FileUploader\Resource\Persister\ImagePersisterInterface;
use Zf2FileUploader\Service\Cleaner\CleanerStrategyInterface;
use Zf2FileUploader\Service\Resource\Response\ImageResponse;
use Zf2FileUploader\Service\Resource\Response\ImageResponseInterface;

class SaveService implements SaveServiceInterface
{
    /**
     * @var ImagePersisterInterface
     */
    protected $persister;

    /**
     * @var DecorateService | null
     */
    protected $decorateService = null;

    /**
     * @var TranslatorInterface
     */
    protected $translator;

    /**
     * @var CleanerStrategyInterface
     */
    protected $cleaner;

    /**
     * Messages might be rised while service working
     */
    const MESSAGE_EXCEPTION = 'exception';
    const MESSAGE_COULD_NOT_PERSIST = 'persist';

    protected $translateMessages = array(
        self::MESSAGE_EXCEPTION => 'Resource [ %s ] could not be saved, because of system error',
        self::MESSAGE_COULD_NOT_PERSIST => 'Could not persist resource [ %s ]'

    );

    /**
     * @param ImagePersisterInterface $persister
     * @param DecorateServiceInterface $decorateService
     * @param CleanerStrategyInterface $cleaner
     * @param TranslatorInterface $translator
     */
    public function __construct(ImagePersisterInterface $persister,
                                DecorateServiceInterface $decorateService = null,
                                CleanerStrategyInterface $cleaner,
                                TranslatorInterface $translator)
    {
        $this->persister = $persister;
        $this->decorateService = $decorateService;
        $this->translator = $translator;
        $this->cleaner = $cleaner;
    }

    /**
     * @param ImageResourceInterface $resource
     * @param ImageResponseInterface $response
     * @return ImageResponseInterface
     * @throws \Exception
     */
    public function save(ImageResourceInterface $resource, ImageResponseInterface $response = null)
    {
        if (is_null($response)) {
            $response = new ImageResponse($resource);
        }

        $this->cleaner->clean();

        try {
            if (!$this->persister->persist($resource)) {
                $message = $this->translator->translate($this->translateMessages[self::MESSAGE_COULD_NOT_PERSIST]);
                $response->addMessage(sprintf($message, $resource->getPath()));
                $response->fail();
                return $response;
            }

            if (!is_null($this->decorateService)) {
                $handleResponse = $this->decorateService->decorate($resource);
                if (!$handleResponse->isSuccess()) {
                    foreach($handleResponse->getMessages() as $message) {
                        $response->addMessage($message);
                    }
                    $response->fail();
                    return $response;
                }
            }

            $this->persister->commit();

        } catch (\Exception $e) {
            $this->persister->rollback();
            throw $e;
        }

        return $response;
    }

    /**
     * @param ImageResourceInterface[] $resources
     * @return ImageResourceInterface[]
     */
    public function saveCollection(array $resources)
    {
        $responses = array();

        foreach ($resources as $resource) {
            $response = $this->save($resource);
            if ($response->isSuccess()) {
                $responses[] = $response;
            } else {
                return array($response);
            }
        }

        return $responses;
    }
}
