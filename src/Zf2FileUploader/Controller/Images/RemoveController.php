<?php
namespace Zf2FileUploader\Controller\Images;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Zend\Mvc\MvcEvent;
use Zf2FileUploader\Controller\AbstractRemoveController;
use Zf2FileUploader\Options\ImageResourceOptionsInterface;
use Zf2FileUploader\Resource\Handler\Remover\RemoverInterface;
use Zf2FileUploader\View\Model\RemoveModel;
use Zf2FileUploader\View\Model\UploaderModel;

class RemoveController extends AbstractRemoveController
{
    /**
     * @var RemoverInterface
     */
    protected $remover;

    /**
     * @var EntityRepository
     */
    protected $repository;

    /**
     * @param EntityManager $entityManager
     * @param ImageResourceOptionsInterface $options
     * @param RemoverInterface $remover
     */
    public function __construct(EntityManager $entityManager,
                                ImageResourceOptionsInterface $options,
                                RemoverInterface $remover)
    {
        $this->remover = $remover;
        $this->repository = $entityManager->getRepository($options->getImageEntityClass());
    }

    /**
     * @return EntityRepository
     */
    protected function getRepository()
    {
        return $this->repository;
    }

    /**
     * @param MvcEvent $e
     * @return mixed | void
     */
    public function onDispatch(MvcEvent $e)
    {
        $removeModel = new RemoveModel();

        if (!$this->remover->remove($this->getResource())) {
            $removeModel->fail();
        } else {
            $removeModel->success();
        }

        $e->setResult($removeModel);
    }
}
