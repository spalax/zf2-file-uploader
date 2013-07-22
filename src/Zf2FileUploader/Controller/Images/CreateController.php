<?php
namespace Zf2FileUploader\Controller\Images;

use Zf2FileUploader\Controller\AbstractCreateController;
use Zend\Mvc\MvcEvent;
use Zf2FileUploader\InputData\CreateImageResourceData;
use Zf2FileUploader\InputData\ResourceDataInterface;
use Zf2FileUploader\Options\ImageResourceOptionsInterface;
use Zf2FileUploader\Service\Resource\SaveService;
use Zf2FileUploader\View\Model\ResponseUploaderModel;

class CreateController extends AbstractCreateController
{
    /**
     * @var SaveService
     */
    protected $saveService = null;

    /**
     * @var ImageResourceOptionsInterface
     */
    protected $options;

    /**
     * @param CreateImageResourceData $createResourceData
     * @param SaveService $saveService
     */
    public function __construct(CreateImageResourceData $createResourceData,
                                SaveService $saveService,
                                ImageResourceOptionsInterface $options)
    {
        parent::__construct($createResourceData);
        $this->saveService = $saveService;
        $this->options = $options;
    }

    public function onDispatch(MvcEvent $e)
    {
        $responses = $this->saveService->saveCollection($this->createResourceData->getResources());
        $e->setResult(new ResponseUploaderModel($responses, $this->options));
    }
}
