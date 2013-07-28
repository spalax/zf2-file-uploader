<?php
namespace Zf2FileUploader\Service\Resource\Image;

use Zf2FileUploader\I18n\Translator\TranslatorInterface;
use Zf2FileUploader\Resource\Handler\Decorator\ImageDecoratorInterface;
use Zf2FileUploader\Resource\ImageResourceInterface;
use Zf2FileUploader\Service\Resource\Response\ImageResponse;
use Zf2FileUploader\Service\Resource\Response\ImageResponseInterface;

class DecorateService implements DecorateServiceInterface
{
    /**
     * @var ImageDecoratorInterface
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
     * @param ImageDecoratorInterface $decorator
     * @param TranslatorInterface $translator
     */
    public function __construct(ImageDecoratorInterface $decorator,
                                TranslatorInterface $translator)
    {
        $this->decorator = $decorator;
        $this->translator = $translator;
    }

    /**
     * @param ImageResourceInterface $resource
     * @param ImageResponseInterface $response
     * @return ImageResponseInterface
     */
    public function decorate(ImageResourceInterface $resource, ImageResponseInterface $response = null)
    {
        if (is_null($response)) {
            $response = new ImageResponse($resource);
        }

        try {
            if (!$this->decorator->decorate($resource)) {
                $message = $this->translator->translate($this->translateMessages[self::MESSAGE_COULD_NOT_DECORATE]);
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
     * @param ImageResourceInterface[] $resources
     * @return ImageResourceInterface[]
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
