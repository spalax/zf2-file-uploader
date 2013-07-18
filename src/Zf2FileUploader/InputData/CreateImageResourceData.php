<?php

namespace Zf2FileUploader\InputData;

use Zf2FileUploader\Resource\ImageResourceFactory;
use Zend\InputFilter\FileInput;
use Zend\Validator\File\MimeType;

class CreateImageResourceData extends AbstractResourceData
{
    public function __construct(ImageResourceFactory $resourceFactory, $fileInputName = 'resource')
    {
        $fileInput = new FileInput($fileInputName);
        $fileInput->setRequired(true);


        $fileInput->getValidatorChain()
                  ->attach(new MimeType(array('image/jpeg',
                                              'image/png',
                                              'image/gif')));

        $this->add($fileInput);

        parent::__construct($resourceFactory);
    }
}