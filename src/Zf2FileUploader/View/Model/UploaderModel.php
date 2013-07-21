<?php
namespace Zf2FileUploader\View\Model;

use Zend\View\Model\ViewModel;
use Zf2FileUploader\View\Model\Exception\InvalidArgumentException;
use Zf2FileUploader\MessagesInterface;

abstract class UploaderModel extends ViewModel
{
    const STATUS_SUCCESS = 'success';
    const STATUS_FAILED = 'failed';

    /**
     * Uploader model is usually terminal
     *
     * @var bool
     */
    protected $terminate = true;

    /**
     * @param MessagesInterface[] | MessagesInterface
     * @throws InvalidArgumentException
     */
    protected function setMessages($messages)
    {
        $messagesVariable = array();
        if (is_array($messages)) {
            foreach ($messages as $message) {
                if (!$message instanceof MessagesInterface) {
                    throw new InvalidArgumentException("Message must be type of MessagesInterface");
                }
                $messagesVariable = array_merge($messagesVariable, $message->getMessages());
            }
        } else if ($messages instanceof MessagesInterface) {
            $messagesVariable = $messages->getMessages();
        } else {
            throw new InvalidArgumentException("Message must be type of MessagesInterface or array of MessagesInterface");
        }

        $this->setVariable('messages', $messagesVariable);
    }
}
