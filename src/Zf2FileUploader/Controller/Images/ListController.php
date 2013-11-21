<?php
namespace Zf2FileUploader\Controller\Images;

use Doctrine\ORM\EntityManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Zf2FileUploader\Paginator\DoctrineQueryRestPaginator;
use Zf2FileUploader\Stdlib\Extractor\Paginator\ImageExtractor;
use Zend\Mvc\Controller\AbstractController;
use Zend\Mvc\MvcEvent;
use Doctrine\ORM\Query\Expr;
use Zf2FileUploader\Options\ImageResourceOptionsInterface;
use Zf2Libs\Paginator\Doctrine\ViewModel\JsonModel;

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
    public function __construct(EntityManager $entityManager, ImageResourceOptionsInterface $options)
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
        $paginator = new DoctrineQueryRestPaginator($this->entityManager
                                                         ->getRepository($this->options->getImageEntityClass())
                                                         ->createQueryBuilder('img'),
                                                    $e->getRequest(),
                                                    $e->getResponse());

        $imageExtractor = new ImageExtractor(new DoctrineObject($this->entityManager,
                                                                $this->options->getImageEntityClass()));

        $result = new JsonModel($imageExtractor);
        $result->setPaginator($paginator);

        $e->setResult($result);
    }
}
