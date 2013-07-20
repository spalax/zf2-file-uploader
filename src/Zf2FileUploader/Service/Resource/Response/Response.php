<?php
/**
 * Created by JetBrains PhpStorm.
 * User: oleksiimilotskyi
 * Date: 7/20/13
 * Time: 2:21 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Zf2FileUploader\Service\Resource\Response;

use Zf2FileUploader\Resource\ResourceInterface;

class Response implements ResponseInterface
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
     * @var ResourceInterface
     */
    protected $resource;

    public function __construct(ResourceInterface $resource)
    {
        $this->resource = $resource;
    }

    /**
     * @param string $message
     * @return ResponseInterface
     */
    public function addMessage($message)
    {
        $this->messages[] = $message;
    }

    /**
     * @return array
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * @return ResourceInterface
     */
    public function getResource()
    {
        $this->resource;
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