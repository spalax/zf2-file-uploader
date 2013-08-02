<?php

namespace Zf2FileUploader\InputFilter\Image;

use Zend\InputFilter\InputFilter;
use Zf2FileUploader\InputFilter\Image\CreateResourceInterface as ImageCreateResourceFilterInterface;
use Zf2FileUploader\MessagesInterface;
use Zf2FileUploader\Resource\ImageResourceInterface;
use Zf2FileUploader\Input\Image\CreateResourceInterface as InputImageCreateResourceInterface;

class CreateResource extends InputFilter implements ImageCreateResourceFilterInterface,
                                                    MessagesInterface
{
    /**
     * @var CreateResourceInterface
     */
    protected $resourceInput;

    /**
     * @param InputImageCreateResourceInterface $resourceInput
     */
    public function __construct(InputImageCreateResourceInterface $resourceInput)
    {
        $this->resourceInput = $resourceInput;
        $this->add($resourceInput);
    }

    /**
     * @return ImageResourceInterface[]
     */
    public function getResources()
    {
        return $this->resourceInput->getResources();
    }
}