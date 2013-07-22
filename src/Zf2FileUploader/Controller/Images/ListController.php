<?php
namespace Zf2FileUploader\Controller\Images;

use Doctrine\ORM\EntityManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Zf2FileUploader\Paginator\DoctrineQueryRestPaginator;
use Zf2FileUploader\View\Model\PaginatorJsonModel;
use Zend\Mvc\Controller\AbstractController;
use Zend\Mvc\MvcEvent;
use Doctrine\ORM\Query\Expr;
use Zf2FileUploader\Options\ImageResourceOptionsInterface;

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
     */
    public function __construct(EntityManager $entityManager, ImageResourceOptionsInterface $options)
    {
        $this->entityManager = $entityManager;
        $this->options = $options;
    }

    /* (non-PHPdoc)
     * @see Zend\Mvc\Controller.AbstractActionController::onDispatch()
     */
    public function onDispatch(MvcEvent $e)
    {
        $paginator = new DoctrineQueryRestPaginator($this->entityManager
                                                         ->getRepository($this->options->getImageEntityClass())
                                                         ->createQueryBuilder('img'),
                                                    $e->getRequest(),
                                                    $e->getResponse());

        $objectHydrator = new DoctrineObject($this->entityManager,
                                             $this->options->getImageEntityClass());

        $result = new PaginatorJsonModel($objectHydrator);
        $result->setPaginator($paginator);

        $e->setResult($result);
    }
}
