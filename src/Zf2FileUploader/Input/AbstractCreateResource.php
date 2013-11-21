<?php
namespace Zf2FileUploader\Input;

use Zf2FileUploader\Resource\ResourceInterface as ResourceResourceInterface;
use Zend\InputFilter\FileInput;

abstract class AbstractCreateResource extends FileInput
{
    /**
     * @return ResourceResourceInterface[]
     */
    protected function createResources()
    {
        $value = parent::getValue();
        if ($this->isValid && is_array($value)) {
            $value = $this->getResource($value);
        }

        return $value;
    }

    /**
     * @param array $value
     * @return array
     */
    protected function getResource($value)
    {
        $resources = array();
        if (is_array($value) && !array_key_exists('tmp_name', $value)) {
            foreach ($value as $oneValue) {
                $resources[] = $this->createResource($oneValue);
            }
        } else {
            $resources[] = $this->createResource($value);
        }
        return $resources;
    }

    /**
     * @param array $data
     * @return ResourceResourceInterface[]
     */
    abstract protected function createResource(array $data);
}
