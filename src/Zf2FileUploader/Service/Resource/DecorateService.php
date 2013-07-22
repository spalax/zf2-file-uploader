<?php
namespace Zf2FileUploader\Service\Resource;

use Zend\I18n\Translator\Translator;
use Zf2FileUploader\I18n\Translator\TranslatorInterface;
use Zf2FileUploader\Resource\Decorator\DecoratorInterface;
use Zf2FileUploader\Resource\ResourceInterface;
use Zf2FileUploader\Service\Resource\Response\Response;
use Zf2FileUploader\Service\Resource\Response\ResponseInterface;

class DecorateService
{
    /**
     * @var DecoratorInterface
     */
    protected $decorator;

    /**
     * @var TranslatorInterface
     */
    protected $translator;

    /**
     * Messages might be raised while service working
     */
    const MESSAGE_EXCEPTION = 'exception';
    const MESSAGE_COULD_NOT_DECORATE = 'decorate';

    protected $translateMessages = array(
        self::MESSAGE_EXCEPTION => 'Resource [ %s ] could not be decorated, because of system error',
        self::MESSAGE_COULD_NOT_DECORATE => 'Could not decorate resource [ %s ]'
    );

    /**
     * @param DecoratorInterface $decorator
     * @param TranslatorInterface $translator
     */
    public function __construct(DecoratorInterface $decorator,
                                TranslatorInterface $translator)
    {
        $this->decorator = $decorator;
        $this->translator = $translator;
    }

    /**
     * @param ResourceInterface $resource
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function decorate(ResourceInterface $resource, ResponseInterface $response = null)
    {
        if (is_null($response)) {
            $response = new Response($resource);
        }

        try {
            if (!$this->decorator->decorate($resource)) {
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
    public function decorateCollection(array $resources)
    {
        $responses = array();

        foreach ($resources as $resource) {
            $response = $this->decorate($resource);
            if ($response->isSuccess()) {
                $responses[] = $response;
            } else {
                return array($response);
            }
        }

        return $responses;
    }
}
