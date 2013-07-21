<?php
namespace Zf2FileUploader\Paginator;

use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Zend\Http\PhpEnvironment\Request;
use Zend\Http\PhpEnvironment\Response;
use Zf2Libs\Paginator\DojoRestStore\Paginator as RestStorePaginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapterPaginator;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrinePaginator;

class DoctrineQueryRestPaginator extends RestStorePaginator
{
    /**
     * @param Query | QueryBuilder $query
     * @param Request $request
     * @param Response $response
     */
    public function __construct($query, Request $request, Response $response)
    {
        $adapter = new DoctrineAdapterPaginator(new DoctrinePaginator($query));
        parent::__construct($adapter, $request, $response);
    }
}