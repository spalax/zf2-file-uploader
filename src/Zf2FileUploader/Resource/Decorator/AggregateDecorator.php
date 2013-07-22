<?php
namespace Zf2FileUploader\Resource\Decorator;

use Zf2FileUploader\Resource\ResourceInterface;

class AggregateDecorator implements DecoratorInterface
{
    /**
     * @var DecoratorInterface[]
     */
    protected $decorators = array();

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
     * @param DecoratorInterface $decorator
     * @return AggregateDecorator
     */
    public function addDecorator(DecoratorInterface $decorator)
    {
        $this->decorators[] = $decorator;
        return $this;
    }

    /**
     * @param DecoratorInterface $resource
     * @return boolean
     */
    public function decorate(ResourceInterface $resource)
    {
        foreach ($this->decorators as $decorator) {
            if (!$decorator->decorate($resource) && $this->stopIfOneFail) {
                return false;
            }
        }

        return true;
    }
}