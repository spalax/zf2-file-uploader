<?php
namespace Zf2FileUploader\InputFilter;

use Zf2FileUploader\InputFilter\Exception\InvalidArgumentException;
use Zf2FileUploader\MessagesInterface;

interface ResourceInterface extends MessagesInterface
{
    /**
     * @param  array | \Traversable $data
     * @throws InvalidArgumentException
     * @return ResourceInterface
     */
    public function setData($data);

    /**
     * @return boolean
     */
    public function isValid();
}