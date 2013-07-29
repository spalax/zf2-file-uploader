<?php
namespace Zf2FileUploader\Controller;

use Zf2FileUploader\InputFilter\ResourceInterface as ResourceDataInterface;
use Zend\Mvc\Controller\AbstractController;
use Zend\Mvc\MvcEvent;
use Zend\Stdlib\RequestInterface as Request;
use Zend\Stdlib\ResponseInterface as Response;
use Zend\Http\PhpEnvironment\Response as HttpResponse;
use Zf2FileUploader\View\Model\UploaderModel;

abstract class AbstractCreateController extends AbstractController
{
    /**
     * @var boolean
     */
    protected $disableDefaultErrorHandler = false;

    /**
     * @return ResourceDataInterface
     */
    abstract protected function getDataResourceCreator();

    /**
     * @param bool $flag
     * @return $this
     */
    public function setDisableDefaultErrorHandler($flag = false)
    {
        $this->disableDefaultErrorHandler = $flag;
        return $this;
    }

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
        $this->request = $request;
        $this->getDataResourceCreator()->setData(array_merge_recursive($this->params()->fromPost(),
                                                                       $request->getFiles()->toArray()));


        if (!$this->getDataResourceCreator()->isValid()) {
            if ($this->disableDefaultErrorHandler) {
                $response = $response ?: new HttpResponse();
                $this->getEventManager()->clearListeners(MvcEvent::EVENT_DISPATCH);
                $this->getEvent()->setResult(false);
                $response->setStatusCode(400);
            } else {
                $this->getEventManager()->clearListeners(MvcEvent::EVENT_DISPATCH);
                $this->getEvent()->setResult(new UploaderModel($this->getDataResourceCreator()));
            }
        }

        parent::dispatch($request, $response);
    }
}
