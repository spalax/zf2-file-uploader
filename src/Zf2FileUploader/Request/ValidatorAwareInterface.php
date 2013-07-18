<?php

namespace Zf2FileUploader\Request;

use Zend\Validator\ValidatorInterface;
interface ValidatorAwareInterface
{
    public function setValidator(ValidatorInterface $validator);
}