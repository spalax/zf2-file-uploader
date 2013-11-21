<?php
namespace Zf2FileUploader\View\Model;

use Zend\View\Model\ModelInterface;
use Zf2FileUploader\Resource\ResourceViewableInterface;
use Zf2FileUploader\View\Model\Exception\InvalidArgumentException;
use Zf2Libs\Stdlib\Messages\MessagesInterface;

interface UploaderModelInterface extends ModelInterface
{
    /**
     * @return UploaderModelInterface
     */
    public function success();

    /**
     * @return UploaderModelInterface
     */
    public function fail();

    /**
     * @param MessagesInterface[] | MessagesInterface | \Traversable | string
     * @throws InvalidArgumentException
     */
    public function setMessages($messages);

    /**
     * @param ResourceViewableInterface $resource
     */
    public function addResource(ResourceViewableInterface $resource);

    /**
     * @param string | MessagesInterface $message
     * @return UploaderModel
     * @throws InvalidArgumentException
     */
    public function addMessage($message);
}
