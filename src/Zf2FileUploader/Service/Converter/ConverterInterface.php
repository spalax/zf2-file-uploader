<?php
namespace Zf2FileUploader\Service\Converter;

use Zf2FileUploader\Entity\ResourceInterface;

interface ConverterInterface
{
    /**
     * @param ResourceInterface $resource
     * @return mixed
     */
    public function convert(ResourceInterface $resource);
}