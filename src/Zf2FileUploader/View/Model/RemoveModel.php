<?php
namespace Zf2FileUploader\View\Model;

use Zend\View\Model\JsonModel;

class RemoveModel extends JsonModel
{
    const STATUS_SUCCESS = 1;
    const STATUS_FAILED = 0;

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
        return $this;
    }
}
