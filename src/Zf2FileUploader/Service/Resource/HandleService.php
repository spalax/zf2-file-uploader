<?php
namespace Zf2FileUploader\Service\Resource;

use Zend\I18n\Translator\Translator;
use Zf2FileUploader\I18n\Translator\TranslatorInterface;
use Zf2FileUploader\Resource\Handler\HandlerInterface;
use Zf2FileUploader\Resource\ResourceInterface;
use Zf2FileUploader\Service\Resource\Response\Response;
use Zf2FileUploader\Service\Resource\Response\ResponseInterface;

class HandleService
{
    /**
     * @var HandlerInterface
     */
    protected $handler;

    /**
     * @var TranslatorInterface
     */
    protected $translator;

    /**
     * Messages might be raised while service working
     */
    const MESSAGE_EXCEPTION = 'exception';
    const MESSAGE_COULD_NOT_HANDLE = 'handle';

    protected $translateMessages = array(
        self::MESSAGE_EXCEPTION => 'Resource [ %s ] could not be handled, because of system error',
        self::MESSAGE_COULD_NOT_HANDLE => 'Could not handle resource [ %s ]'
    );

    /**
     * @param HandlerInterface $handler
     * @param TranslatorInterface $translator
     */
    public function __construct(HandlerInterface $handler,
                                TranslatorInterface $translator)
    {
        $this->handler = $handler;
        $this->translator = $translator;
    }

    /**
     * @param ResourceInterface $resource
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function handle(ResourceInterface $resource, ResponseInterface $response = null)
    {
        if (is_null($response)) {
            $response = new Response($resource);
        }

        try {
            if (!$this->handler->handle($resource)) {
                $message = $this->translator->translate($this->translateMessages[self::MESSAGE_COULD_NOT_HANDLE]);
                $response->addMessage(sprintf($message, $resource->getPath()));
                $response->fail();
                return $response;
            }
        } catch (\Exception $e) {
            $message = $this->translator->translate($this->translateMessages[self::MESSAGE_EXCEPTION]);
            $response->addMessage(sprintf($message, $resource->getPath()));
            $response->fail();
            return $response;
        }

        return $response;
    }

    /**
     * @param ResourceInterface[] $resources
     * @return ResponseInterface[]
     */
    public function handleCollection(array $resources)
    {
        $responses = array();

        foreach ($resources as $resource) {
            $response = $this->handle($resource);
            if ($response->isSuccess()) {
                $responses[] = $response;
            } else {
                return array($response);
            }
        }

        return $responses;
    }
}
