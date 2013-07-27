<?php

namespace Zf2FileUploader\InputData;

use Zend\InputFilter\FileInput;
use Zend\Validator\File\MimeType;
use Zf2FileUploader\Resource\AbstractResourceFactoryInterface;
use Zf2FileUploader\Resource\ImageResourceInterface;

class CreateImageResourceData extends AbstractResourceData implements ImageResourceDataInterface
{
    /**
     * @var AbstractResourceFactoryInterface
     */
    protected $abstractResourceFactory;

    /**
     * @param AbstractResourceFactoryInterface $resourceFactory
     * @param string $fileInputName
     */
    public function __construct(AbstractResourceFactoryInterface $resourceFactory, $fileInputName = 'resource')
    {
        $fileInput = new FileInput($fileInputName);
        $fileInput->setRequired(true);

        $fileInput->getValidatorChain()
                  ->attach(new MimeType(array('image/jpeg',
                                              'image/png',
                                              'image/gif')));

        $this->add($fileInput);
        $this->abstractResourceFactory = $resourceFactory;
    }

    /**
     * @param array $data
     * @return ImageResourceInterface[]
     */
    protected function createResource(array $data)
    {
        return $this->abstractResourceFactory->createImageResource($data);
    }

    /**
     * @return ImageResourceInterface[]
     */
    public function getResources()
    {
        return $this->createResources();
    }
}