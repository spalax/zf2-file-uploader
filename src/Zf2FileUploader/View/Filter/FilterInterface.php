<?php
namespace Zf2FileUploader\View\Filter;

use Zf2FileUploader\Resource\ResourceViewableInterface;

interface FilterInterface
{
    /**
     * @param ResourceViewableInterface $resource
     * @return ResourceViewableInterface
     */
    public function filter(ResourceViewableInterface $resource);
}