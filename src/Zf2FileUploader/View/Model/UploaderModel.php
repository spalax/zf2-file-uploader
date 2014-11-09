<?php
namespace Zf2FileUploader\View\Model;

use Zend\View\Model\ViewModel;
use Zf2FileUploader\Resource\ResourceViewableInterface;
use Zf2FileUploader\View\Filter\FilterInterface;
use Zf2FileUploader\View\Model\Exception\InvalidArgumentException;
use Zf2Libs\Stdlib\Messages\MessagesInterface;

class UploaderModel extends ViewModel implements UploaderModelInterface
{
    const STATUS_SUCCESS = 1;
    const STATUS_FAILED = 0;

    /**
     * Uploader model is usually terminal
     *
     * @var bool
     */
    protected $terminate = true;

    /**
     * @var FilterInterface
     */
    protected $filter = null;

    public function __construct(FilterInterface $filter = null)
    {
        $this->filter = $filter;
    }

    /**
     * @return UploaderModel
     */
    public function success()
    {
        $this->setVariable('status', self::STATUS_SUCCESS);
        return $this;
    }

    /**
     * @return UploaderModel
     */
    public function fail()
    {
        $this->setVariable('status', self::STATUS_FAILED);
        $this->setVariable('resources', array());
        return $this;
    }

    /**
     * @param MessagesInterface[] | MessagesInterface | \Traversable | string
     * @throws InvalidArgumentException
     */
    public function setMessages($messages)
    {
        $this->setVariable('messages', array());

        if (is_array($messages)) {
            foreach ($messages as $message) {
                $this->addMessage($message);
            }
        } else {
            $this->addMessage($messages);
        }
    }

    /**
     * @param ResourceViewableInterface $resource
     */
    public function addResource(ResourceViewableInterface $resource)
    {
        if (!is_null($this->filter)) {
            $resource = $this->filter->filter(clone $resource);
        }

        $resources = $this->getVariable('resources', array());
        $resources[$resource->getToken()] = $resource->getHttpPath();
        $this->setVariable('resources', $resources);
    }

    /**
     * @return array
     */
    public function getResourcePaths()
    {
        return $this->getVariable('resources');
    }

    /**
     * @param string | MessagesInterface $message
     * @return UploaderModel
     * @throws InvalidArgumentException
     */
    public function addMessage($message)
    {
        $messages = $this->getVariable('messages', array());

        if (is_string($message)) {
            $messages[] =(string)$message;
        } else if ($message instanceof MessagesInterface) {
            $messages = array_merge($messages, $message->getMessages());
        } else {
            throw new InvalidArgumentException("Message must be type of MessagesInterface or string");
        }

        $this->setVariable('messages', $messages);
    }
}
