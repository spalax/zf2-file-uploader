<?php

namespace Zf2FileUploader\InputData;

use Zend\InputFilter\FileInput;
use Zend\Validator\File\MimeType;

class CreateResourceData extends AbstractResourceData
{
    public function __construct($fileInputName = 'resource')
    {
        $fileInput = new FileInput($fileInputName);
        $fileInput->setRequired(true);
        $this->add($fileInput);
    }
}