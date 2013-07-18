<?php
namespace Zf2FileUploader\View\Model;

use Zf2FileUploader\InputData\ResourceDataInterface;

class FailedUploaderModel extends UploaderModel
{
    public function __construct(ResourceDataInterface $resourceData)
    {
        $this->setVariable('status', 'failed');
        $this->setVariable('messages', $resourceData->getMessages());
    }
}
