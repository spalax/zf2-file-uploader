<?php
namespace Zf2FileUploader\Controller;

use Doctrine\ORM\EntityRepository;
use Zend\Mvc\Controller\AbstractController;
use Zend\Mvc\MvcEvent;
use Zend\Stdlib\RequestInterface as Request;
use Zend\Stdlib\ResponseInterface as Response;
use Zend\Http\PhpEnvironment\Response as HttpResponse;
use Zf2FileUploader\Entity\ResourceInterface as EntityResourceInterface;
use Zf2FileUploader\View\Model\UploaderModel;

abstract class AbstractRemoveController extends AbstractController
{
    const REMOVE_ROUTE_PARAM = 'token';

    /**
     * @var EntityResourceInterface
     */
    protected $resourceEntity = null;

    /**
     * @return EntityResourceInterface
     */
    protected function getResource()
    {
        return $this->resourceEntity;
    }

    /**
     * @return EntityRepository
     */
    abstract protected function getRepository();

    /**
     * Dispatch a request
     *
     * @events dispatch.pre, dispatch.post
     * @param  Request $request
     * @param  null|Response $response
     * @return Response|mixed
     */
    public function dispatch(Request $request, Response $response = null)
    {
        $this->resourceEntity = $this->getRepository()->findOneByToken($this->params()
                                                                            ->fromRoute(static::REMOVE_ROUTE_PARAM));

        if (is_null($this->resourceEntity)) {
            $response = $response ?: new HttpResponse();
            $this->getEventManager()->clearListeners(MvcEvent::EVENT_DISPATCH);
            $response->setStatusCode(404);
        }

        parent::dispatch($request, $response);
    }
}
