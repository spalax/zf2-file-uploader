<?php
namespace Zf2FileUploader\Service\Resource\Response;

abstract class AbstractResponse implements ResponseInterface
{
    /**
     * @var array
     */
    protected $messages = array();

    /**
     * @var bool
     */
    protected $failed = false;

    /**
     * @param string $message
     * @return ResponseInterface
     */
    public function addMessage($message)
    {
        $this->messages[] = $message;
        return $this;
    }

    /**
     * @return array
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * @return boolean
     */
    public function isSuccess()
    {
        return !$this->failed;
    }

    /**
     * @return ResponseInterface
     */
    public function fail()
    {
        $this->failed = true;
    }

}