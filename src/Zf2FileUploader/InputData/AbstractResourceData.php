<?php
namespace Zf2FileUploader\InputData;

use Zf2FileUploader\Resource\ResourceInterface;
use Zend\InputFilter\Exception\InvalidArgumentException;
use Zf2FileUploader\InputData\Exception\InvalidArgumentException as InputDataInvalidArgumentException;
use Zend\InputFilter\FileInput;
use Zend\InputFilter\InputFilter;

abstract class AbstractResourceData extends InputFilter implements ResourceDataInterface
{
    /**
     * @return ResourceInterface[]
     */
    protected function createResources()
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
                    $resources[] = $this->createResource(array_merge_recursive($data, $oneValue));
                }
            } else {
                $resources[] = $this->createResource(array_merge_recursive($data, $value));
            }
        }

        return $resources;
    }

    /**
     * @param array $data
     * @return ResourceInterface[]
     */
    abstract protected function createResource(array $data);

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