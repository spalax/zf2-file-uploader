<?php
namespace Zf2FileUploader\View\Model;

use Zf2FileUploader\InputData\ResourceDataInterface;

class SuccessUploaderModel extends UploaderModel
{
    public function __construct(ResourceDataInterface $resourceData)
    {
        $this->setVariable('status', 'success');
        $this->setVariable('messages', $resourceData->getMessages());
    }
}
