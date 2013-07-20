<?php
/**
 * Created by JetBrains PhpStorm.
 * User: oleksiimilotskyi
 * Date: 7/20/13
 * Time: 2:38 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Zf2FileUploader\Service\Resource\Response;

use Zf2FileUploader\Resource\ResourceInterface;

class AggregateResponse implements AggregateResponseInterface
{
    /**
     * @var ResponseInterface[]
     */
    protected $responses = array();

    /**
     * @return boolean
     */
    public function isSuccess()
    {
        foreach ($this->responses as $response) {
            if (!$response->isSuccess()) return false;
        }

        return true;
    }

    /**
     * @param ResponseInterface $response
     * @return AggregateResponseInterface
     */
    public function addResponse(ResponseInterface $response)
    {
        $this->responses[] = $response;
    }

    /**
     * @return ResourceInterface[]
     */
    public function getResources()
    {
        $resources = array();
        foreach ($this->responses as $response) {
            $resources[] = $response->getResource();
        }

        return $resources;
    }

    /**
     * @return array
     */
    public function getMessages()
    {
        $messages = array();
        foreach ($this->responses as $response) {
            $messages = array_merge($messages, $response->getMessages());
        }

        return $messages;
    }
}