<?php
namespace Zf2FileUploader\View\Model;

use Zf2FileUploader\Resource\ResourceInterface;
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
     * @param ResourceInterface $resource
     */
    protected function addResource(ResourceInterface $resource)
    {
        $resources = $this->getVariable('resources', array());
        $resources[] = $resource->getPath();
        $this->setVariable('resources', $resources);
    }
}
