<?php
namespace Zf2FileUploader\Filter\Thumbnail;

use Imagine\Image\BoxInterface;
use Zend\Filter\Exception;

interface PathFilterFactoryInterface
{
    /**
     * @param array | BoxInterface $data
     *
     * @return PathFilter
     */
    public function getPathFilter($data);
}