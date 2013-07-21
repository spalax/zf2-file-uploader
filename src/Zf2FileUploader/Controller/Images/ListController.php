<?php
namespace Zf2FileUploader\Controller\Images;

use Doctrine\ORM\EntityManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Front\Paginator\DoctrineQueryRestPaginator;
use Front\View\Model\PaginatorJsonModel;
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
        $query = $this->entityManager->createQuery("SELECT r FROM Zf2FileUploader\Entity\Resource r
                                                    WHERE r IN (SELECT IDENTITY(i.resource)
                                                                FROM {$this->options->getImageEntityClass()} i)");

        $paginator = new DoctrineQueryRestPaginator($query,
                                                    $e->getRequest(),
                                                    $e->getResponse());

        $objectHydrator = new DoctrineObject($this->entityManager,
                                             'Zf2FileUploader\Entity\Resource');

        $result = new PaginatorJsonModel($objectHydrator);
        $result->setPaginator($paginator);

        $e->setResult($result);
    }
}
