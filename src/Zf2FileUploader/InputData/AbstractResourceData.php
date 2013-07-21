<?php
namespace Zf2FileUploader\InputData;

use Zf2FileUploader\MessagesInterface;
use Zf2FileUploader\Resource\ResourceFactory;
use Zf2FileUploader\Resource\ResourceFactoryInterface;
use Zf2FileUploader\Resource\ResourceInterface;
use Zend\InputFilter\Exception\InvalidArgumentException;
use Zf2FileUploader\InputData\Exception\InvalidArgumentException as InputDataInvalidArgumentException;
use Zend\InputFilter\FileInput;
use Zend\InputFilter\InputFilter;

abstract class AbstractResourceData extends InputFilter
          implements ResourceDataInterface,
                     MessagesInterface
{
    /**
     * @var ResourceFactoryInterface | null
     */
    protected $resourceFactory = null;

    public function __construct(ResourceFactoryInterface $resourceFactory = null)
    {
        $this->resourceFactory = $resourceFactory;
    }

    /**
     * @return ResourceFactoryInterface
     */
    protected function getResourceFactory()
    {
        if (is_null($this->resourceFactory)) {
            $this->resourceFactory = new ResourceFactory();
        }

        return $this->resourceFactory;
    }

    /**
     * @return ResourceInterface[]
     */
    public function getResources()
    {
        $resources = array();

        $data = array();

        /* @var $fileInputs FileInput[] */
        $fileInputs = array();

        foreach ($this->getValidInput() as $input) {
            if (!$input instanceof FileInput) {
                $data[$input->getName()] = $input->getValue();
            } else {
                $fileInputs[] = $input;
            }
        }

        foreach ($fileInputs as $input) {
            $value = $input->getValue();
            if (is_array($value) && !array_key_exists('tmp_name', $value)) {
                foreach ($value as $oneValue) {
                    $resources[] = $this->getResourceFactory()->createResource(array_merge_recursive($data, $oneValue));
                }
            } else {
                $resources[] = $this->getResourceFactory()->createResource(array_merge_recursive($data, $value));
            }
        }

        return $resources;
    }

    /**
     * @param array|\Traversable $data
     * @return ResourceDataInterface|void|\Zend\InputFilter\InputFilterInterface
     * @throws Exception\InvalidArgumentException
     */
    public function setData($data)
    {
        try {
            parent::setData($data);
        } catch (InvalidArgumentException $e) {
            throw new InputDataInvalidArgumentException('Invalid data', null, $e);
        }
    }
}