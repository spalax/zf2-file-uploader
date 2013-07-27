<?php
namespace Zf2FileUploader\InputData;

use Zf2FileUploader\InputData\Exception\InvalidArgumentException;
use Zf2FileUploader\MessagesInterface;

interface ResourceDataInterface extends MessagesInterface
{
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