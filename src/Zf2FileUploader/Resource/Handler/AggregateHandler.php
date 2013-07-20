<?php
namespace Zf2FileUploader\Resource\Handler;

use Zf2FileUploader\Resource\ResourceInterface;

class AggregateHandler implements HandlerInterface
{
    /**
     * @var HandlerInterface[]
     */
    protected $handlers = array();

    /**
     * @var bool
     */
    protected $stopIfOneFail = true;

    /**
     * @param bool $stopIfOneFail
     */
    public function __construct($stopIfOneFail = true)
    {
        $this->stopIfOneFail = $stopIfOneFail;
    }

    /**
     * @param HandlerInterface $handler
     * @return AggregateHandler
     */
    public function addHandler(HandlerInterface $handler)
    {
        $this->handlers[] = $handler;
        return $this;
    }

    /**
     * @param HandlerInterface $resource
     * @return boolean
     */
    public function handle(ResourceInterface $resource)
    {
        foreach ($this->handlers as $handler) {
            if (!$handler->handle($resource) && $this->stopIfOneFail) {
                return false;
            }
        }

        return true;
    }
}