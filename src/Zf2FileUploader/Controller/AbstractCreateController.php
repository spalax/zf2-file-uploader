<?php
namespace Zf2FileUploader\Controller;

use Zend\Mvc\Controller\AbstractController;
use Zend\Mvc\MvcEvent;
use Zend\Stdlib\RequestInterface as Request;
use Zend\Stdlib\ResponseInterface as Response;
use Zend\Http\PhpEnvironment\Response as HttpResponse;
use Zf2FileUploader\View\Model\UploaderModelInterface;
use Zf2Libs\Data\DataInterface;

abstract class AbstractCreateController extends AbstractController
{
    /**
     * @var boolean
     */
    protected $disableDefaultErrorHandler = false;

    /**
     * @var UploaderModelInterface
     */
    protected $uploaderModel;

    /**
     * @return DataInterface
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
     * @param UploaderModelInterface $uploaderModel
     */
    public function __construct(UploaderModelInterface $uploaderModel)
    {
        $this->uploaderModel = $uploaderModel;
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
                $this->uploaderModel->setMessages($this->getDataResourceCreator());

                $this->getEvent()->setResult($this->uploaderModel);
            }
        }

        parent::dispatch($request, $response);
    }
}
