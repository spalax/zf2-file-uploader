<?php
namespace Zf2FileUploader\Service\Resource\Response;

use Zf2FileUploader\Resource\ResourceInterface;

interface AggregateResponseInterface
{
    /**
     * @return boolean
     */
    public function isSuccess();

    /**
     * @param ResponseInterface $response
     * @return AggregateResponseInterface
     */
    public function addResponse(ResponseInterface $response);

    /**
     * @return ResourceInterface[]
     */
    public function getResources();

    /**
     * @return \string[]
     */
    public function getMessages();
}