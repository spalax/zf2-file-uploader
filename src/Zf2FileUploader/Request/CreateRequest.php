<?php

namespace Zf2FileUploader\Request;

use Zend\Validator\ValidatorInterface;

class CreateRequest extends AbstractRequest
{
    /**
     * @var ValidatorInterface | null
     */
    protected $validator = null;

    /**
     * @param ValidatorInterface $validator
     */
    public function setValidator(ValidatorInterface $validator)
    {
        $this->eventManager->trigger('uploader.request.setvalidator.pre', $this, array($validator));
        $this->validator = $validator;
        $this->eventManager->trigger('uploader.request.setvalidator.post', $this, array($this->validator));
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        if (is_null($this->validator)) {
            return true;
        }

        return $this->validator->isValid($this->request);
    }

}