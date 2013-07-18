<?php
namespace Front\Controller\Images;

use Doctrine\ORM\EntityManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Front\Paginator\DoctrineQueryRestPaginator;
use Front\Stdlib\Hydrator\Strategy\DoctrineEntities\Photo;
use Front\View\Model\PaginatorJsonModel;
use Zend\Mvc\Controller\AbstractController;
use Zend\Mvc\MvcEvent;

class ListController extends AbstractController
{
    /**
     * @var EntityManager
     */
    protected $entityManager = null;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /* (non-PHPdoc)
     * @see Zend\Mvc\Controller.AbstractActionController::onDispatch()
     */
    public function onDispatch(MvcEvent $e)
    {
        $paginator = new DoctrineQueryRestPaginator($this->entityManager
                                                         ->getRepository('Front\Entities\Photo')
                                                         ->createQueryBuilder('gp'),
                                                    $e->getRequest(),
                                                    $e->getResponse());

        $objectHydrator = new DoctrineObject($this->entityManager, 'Front\Entities\Photo');

        $result = new PaginatorJsonModel($objectHydrator);
        $result->setPaginator($paginator);

        $e->setResult($result);
    }
}
