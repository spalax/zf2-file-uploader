<?php

namespace Zf2FileUploader\Converter;

use Zend\Stdlib\Hydrator\HydratorInterface;
use Zf2FileUploader\Resource\ResourceInterface;
use Zf2FileUploader\Hydrator\Exception\InvalidArgumentException;

class ResourceHydrator implements HydratorInterface
{
    /**
     * Extract values from an object
     *
     * @param  object $object
     * @return array
     */
    public function extract($object)
    {
        if (!$object instanceof ResourceInterface) {
            throw new InvalidArgumentException("Object has invalid type, must be type of ResourceInterface");
        }

        return array('path' => $object->getPath(), 'id' => $object->getId());
    }

    /**
     * Hydrate $object with the provided $data.
     *
     * @param  array $data
     * @param  object $object
     * @return object
     */
    public function hydrate(array $data, $object)
    {
        if (!$object instanceof ResourceInterface) {
            throw new InvalidArgumentException("Object has invalid type, must be type of ResourceInterface");
        }

        if (!array_key_exists('path', $data)) {
            throw new InvalidArgumentException("Data must have path for hydration");
        } else {
            $object->setPath($data['path']);
        }

        if (array_key_exists('id', $data)) {
            $object->setId($data['id']);
        }

        return $object;
    }

}