<?php
namespace Zf2FileUploader\View\Model;

use Zend\Paginator\Paginator;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\View\Model\JsonModel;

class PaginatorJsonModel extends JsonModel
{
    /**
     * @var HydratorInterface
     */
    protected $hydrator = null;

    /**
     * @param HydratorInterface $hydrator
     */
    public function __construct(HydratorInterface $hydrator)
    {
       $this->hydrator = $hydrator;
    }

    /**
     * @param Paginator $paginator
     */
    public function setPaginator(Paginator $paginator)
    {
        foreach ($paginator->getCurrentItems() as $k=>$item) {
            $this->setVariable($k, $this->hydrator->extract($item));
        }
    }
}
