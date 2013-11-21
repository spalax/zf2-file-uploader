<?php
namespace Zf2FileUploader\Controller\Images;

use Zf2FileUploader\Controller\AbstractCreateController;
use Zend\Mvc\MvcEvent;
use Zf2FileUploader\InputFilter\Image\CreateResourceInterface as ImageCreateResourceFilterInterface;
use Zf2FileUploader\Service\Image\SaveServiceInterface;
use Zf2FileUploader\Service\Exception;
use Zf2FileUploader\View\Model\UploaderModel;
use Zf2FileUploader\View\Model\UploaderModelInterface;

class CreateController extends AbstractCreateController
{
    /**
     * @var SaveServiceInterface
     */
    protected $saveService;

    /**
     * @var ImageCreateResourceFilterInterface
     */
    protected $createResourceData;

    /**
     * @param \Zf2FileUploader\View\Model\UploaderModelInterface $uploaderModel
     * @param ImageCreateResourceFilterInterface $createResourceData
     * @param SaveServiceInterface $saveService
     */
    public function __construct(UploaderModelInterface $uploaderModel,
                                ImageCreateResourceFilterInterface $createResourceData,
                                SaveServiceInterface $saveService)
    {
        $this->createResourceData = $createResourceData;
        $this->saveService = $saveService;
        parent::__construct($uploaderModel);
    }

    /**
     * @return ImageCreateResourceFilterInterface
     */
    protected function getDataResourceCreator()
    {
        return $this->createResourceData;
    }

    /**
     * @param \Zend\Mvc\MvcEvent $mvcEvent
     * @return mixed | void
     */
    public function onDispatch(MvcEvent $mvcEvent)
    {
        try {
            foreach ($this->getDataResourceCreator()->getResources() as $resource) {
                $this->saveService->save($resource);
                $this->uploaderModel->addResource($resource);
            }

            $this->uploaderModel->success();
        } catch (\Exception $e) {
            $this->uploaderModel->addMessage($e->getMessage());
            $this->uploaderModel->fail();
        }

        $mvcEvent->setResult($this->uploaderModel);
    }
}
