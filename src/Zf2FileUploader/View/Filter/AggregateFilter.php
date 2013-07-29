<?php
namespace Zf2FileUploader\View\Filter;

use Zf2FileUploader\Resource\ResourceViewableInterface;

class AggregateFilter implements FilterInterface
{
    /**
     * @var FilterInterface[]
     */
    protected $filters = array();

    /**
     * @param FilterInterface $filter
     * @return AggregateFilter
     */
    public function addFilter(FilterInterface $filter)
    {
        $this->filters[] = $filter;
        return $this;
    }

    /**
     * @param ResourceViewableInterface $resource
     * @return ResourceViewableInterface
     */
    public function filter(ResourceViewableInterface $resource)
    {
        foreach ($this->filters as $filter) {
            $resource = $filter->filter($resource);
        }

        return $resource;
    }
}