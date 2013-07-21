<?php
namespace Zf2FileUploader\InputData;

use Zf2FileUploader\Resource\ResourceInterface;
use Zf2FileUploader\InputData\Exception\InvalidArgumentException;

interface ResourceDataInterface
{
    /**
     * @return ResourceInterface[]
     */
    public function getResources();

    /**
     * @param  array | \Traversable $data
     * @throws InvalidArgumentException
     * @return ResourceDataInterface
     */
    public function setData($data);

    /**
     * @return boolean
     */
    public function isValid();
}