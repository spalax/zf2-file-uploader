<?php
namespace Zf2FileUploader\Service\Resource;

use Zf2FileUploader\I18n\Translator\TranslatorInterface;
use Zf2FileUploader\Resource\Persister\PersisterInterface;
use Zf2FileUploader\Resource\ResourceInterface;
use Zf2FileUploader\Service\Cleaner\CleanerStrategyInterface;
use Zf2FileUploader\Service\Resource\Response\Response;
use Zf2FileUploader\Service\Resource\Response\ResponseInterface;

class SaveService
{
    /**
     * @var PersisterInterface
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
     * @param PersisterInterface $persister
     * @param DecorateService $decorateService
     * @param TranslatorInterface $translator
     */
    public function __construct(PersisterInterface $persister,
                                DecorateService $decorateService = null,
                                CleanerStrategyInterface $cleaner,
                                TranslatorInterface $translator)
    {
        $this->persister = $persister;
        $this->decorateService = $decorateService;
        $this->translator = $translator;
        $this->cleaner = $cleaner;
    }

    /**
     * @param ResourceInterface $resource
     * @param ResponseInterface $response
     * @return Response|ResponseInterface
     * @throws \Exception
     */
    public function save(ResourceInterface $resource, ResponseInterface $response = null)
    {
        if (is_null($response)) {
            $response = new Response($resource);
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
     * @param ResourceInterface[] $resources
     * @return ResponseInterface[]
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
