<?php

namespace Zf2FileUploader\InputData;

use Zend\InputFilter\FileInput;
use Zend\Validator\File\MimeType;
use Zf2FileUploader\Resource\ResourceFactoryInterface;

class CreateImageResourceData extends AbstractResourceData
{
    public function __construct(ResourceFactoryInterface $resourceFactory, $fileInputName = 'resource')
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