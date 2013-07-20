<?php

namespace Zf2FileUploader\Request;

use Zend\EventManager\EventManagerInterface;
use Zend\Stdlib\Request;

abstract class AbstractRequest implements RequestInterface
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var EventManagerInterface
     */
    protected $eventManager;

    /**
     * @param Request $request
     */
    public function __construct(EventManagerInterface $eventManager)
    {
        //$this->eventManager = $eventManager;

//        $this->eventManager->trigger('uploader.request.apply.post', $this, array($request));
    }
}