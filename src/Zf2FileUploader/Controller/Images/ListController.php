<?php
namespace Zf2FileUploader\Controller\Images;

use Doctrine\ORM\EntityManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Zf2FileUploader\Stdlib\Extractor\Paginator\ImageExtractor;
use Zend\Mvc\Controller\AbstractController;
use Zend\Mvc\MvcEvent;
use Doctrine\ORM\Query\Expr;
use Zf2FileUploader\Options\ImageResourceOptionsInterface;
use Zf2Libs\Paginator\Doctrine\QueryPaginator;
use Zf2Libs\Paginator\ViewModel\JsonModel;
use Zf2Libs\Paginator\DojoRestStore\Paginator;

class ListController extends AbstractController
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var ImageResourceOptionsInterface
     */
    protected $options;

    /**
     * @param EntityManager $entityManager
     * @param ImageResourceOptionsInterface $options
     */
    public function __construct(EntityManager $entityManager,
                                ImageResourceOptionsInterface $options)
    {
        $this->entityManager = $entityManager;
        $this->options = $options;
    }

    /**
     * @param MvcEvent $e
     * @return mixed|void
     */
    public function onDispatch(MvcEvent $e)
    {

        $adapter = new QueryPaginator($this->entityManager
                                           ->getRepository($this->options->getImageEntityClass())
                                           ->createQueryBuilder('img'));

        $paginator = new Paginator($adapter,
                             $this->getRequest()->getHeaders(),
                             $this->getResponse()->getHeaders());

        $imageExtractor = new ImageExtractor(new DoctrineObject($this->entityManager,
                                                                $this->options->getImageEntityClass()));


        $result = new JsonModel($imageExtractor);
        $result->setPaginator($paginator);

        $e->setResult($result);
    }
}
