<?php
namespace Zf2FileUploader\View\Model;

use Zf2FileUploader\MessagesInterface;

class FailedUploaderModel extends UploaderModel
{
    public function __construct(MessagesInterface $message)
    {
        $this->setVariable('status', static::STATUS_FAILED);
        $this->setMessages($message);
    }
}
