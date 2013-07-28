<?php
namespace Zf2FileUploader\Service\Response;

use Zf2FileUploader\MessagesInterface;
use Zf2FileUploader\Resource\ResourceInterface;

interface ResponseInterface extends MessagesInterface
{
    /**
     * @param string $message
     * @return ResponseInterface
     */
    public function addMessage($message);

    /**
     * @return array
     */
    public function getMessages();

    /**
     * @return boolean
     */
    public function isSuccess();

    /**
     * @return ResponseInterface
     */
    public function fail();

    /**
     * @return ResourceInterface
     */
    public function getResource();
}