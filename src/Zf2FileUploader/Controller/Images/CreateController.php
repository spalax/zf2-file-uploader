<?php
namespace Zf2FileUploader\Controller\Images;

use Zf2FileUploader\Controller\AbstractCreateController;
use Zend\Mvc\MvcEvent;
use Zf2FileUploader\InputData\ImageResourceDataInterface;
use Zf2FileUploader\Service\Resource\Image\SaveServiceInterface;
use Zf2FileUploader\View\Model\ImageResponseUploaderModel;

class CreateController extends AbstractCreateController
{
    /**
     * @var SaveServiceInterface
     */
    protected $saveService = null;

    /**
     * @var ImageResourceDataInterface
     */
    protected $createResourceData;

    /**
     * @param ImageResourceDataInterface $createResourceData
     * @param SaveServiceInterface $saveService
     */
    public function __construct(ImageResourceDataInterface $createResourceData,
                                SaveServiceInterface $saveService)
    {
        $this->createResourceData = $createResourceData;
        $this->saveService = $saveService;
    }

    /**
     * @return ImageResourceDataInterface
     */
    protected function getDataResourceCreator()
    {
        return $this->createResourceData;
    }

    /**
     * @param MvcEvent $e
     * @return mixed | void
     */
    public function onDispatch(MvcEvent $e)
    {
        $responses = $this->saveService->saveCollection($this->getDataResourceCreator()->getResources());
        $e->setResult(new ImageResponseUploaderModel($responses));
    }
}
