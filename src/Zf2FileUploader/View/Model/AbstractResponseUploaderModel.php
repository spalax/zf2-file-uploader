<?php
namespace Zf2FileUploader\View\Model;

use Zf2FileUploader\Resource\ResourceViewableInterface;
use Zf2FileUploader\Service\Response\ResponseInterface;

abstract class AbstractResponseUploaderModel extends UploaderModel
{
    /**
     * @param ResponseInterface $response
     * @return bool
     */
    protected function checkSuccess(ResponseInterface $response)
    {
        if (!$response->isSuccess()) {
            $this->clearVariables();
            $this->setVariable('status', static::STATUS_FAILED);
            $this->setMessages($response);
            return false;
        }
        return true;
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
