<?php
namespace Zf2FileUploader\View\Model;

use Zf2FileUploader\Options\ImageResourceOptionsInterface;
use Zf2FileUploader\Resource\ResourceViewableInterface;
use Zf2FileUploader\Service\Resource\Response\ResponseInterface;
use Zf2FileUploader\View\Model\Exception\InvalidArgumentException;

class ResponseUploaderModel extends UploaderModel
{
    /**
     * @param array $responses
     */
    public function __construct(array $responses)
    {
        foreach ($responses as $response) {
            if (!$response instanceof ResponseInterface) {
                throw new InvalidArgumentException('Response must be type of ResponseInterface');
            }

            if (!$response->isSuccess()) {
                $this->clearVariables();
                $this->setVariable('status', static::STATUS_FAILED);
                $this->setMessages($responses);
                return;
            }

            $this->addResource($response->getResource());
        }

        $this->setVariable('status', static::STATUS_SUCCESS);
        $this->setMessages($responses);
    }

    /**
     * @param ResourceViewableInterface $resource
     */
    protected function addResource(ResourceViewableInterface $resource)
    {
        $resources = $this->getVariable('resources', array());

        $resources[$resource->getToken()] = $resource->getHttpPath();

        $this->setVariable('resources', $resources);
    }
}
