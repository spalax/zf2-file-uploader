<?php

namespace Zf2FileUploader\Input\Image;

use Zend\Validator\File\MimeType;
use Zf2FileUploader\Input\AbstractCreateResource;
use Zf2FileUploader\Resource\AbstractFactory\ResourceInterface as AbstractFactoryResourceInterface;
use Zf2FileUploader\Resource\ImageResourceInterface;

class CreateResource extends AbstractCreateResource implements CreateResourceInterface
{
    /**
     * @var AbstractFactoryResourceInterface
     */
    protected $abstractResourceFactory;

    /**
     * @param AbstractFactoryResourceInterface $resourceFactory
     * @param string $name
     */
    public function __construct(AbstractFactoryResourceInterface $resourceFactory, $name = 'image')
    {
        parent::__construct($name);

        $this->getValidatorChain()
             ->attach(new MimeType(array('image/jpeg',
                                         'image/png',
                                         'image/gif')));

        $this->abstractResourceFactory = $resourceFactory;
    }

    /**
     * @param array $data
     * @return ImageResourceInterface
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