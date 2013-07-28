<?php
namespace Zf2FileUploader\Controller\Images;

use Zf2FileUploader\Controller\AbstractCreateController;
use Zend\Mvc\MvcEvent;
use Zf2FileUploader\InputFilter\Image\CreateResourceInterface as ImageCreateResourceFilterInterface;
use Zf2FileUploader\Service\Image\SaveServiceInterface;
use Zf2FileUploader\Service\Exception;
use Zf2FileUploader\View\Model\UploaderModel;

class CreateController extends AbstractCreateController
{
    /**
     * @var SaveServiceInterface
     */
    protected $saveService = null;

    /**
     * @var ImageCreateResourceFilterInterface
     */
    protected $createResourceData;

    /**
     * @param ImageCreateResourceFilterInterface $createResourceData
     * @param SaveServiceInterface $saveService
     */
    public function __construct(ImageCreateResourceFilterInterface $createResourceData,
                                SaveServiceInterface $saveService)
    {
        $this->createResourceData = $createResourceData;
        $this->saveService = $saveService;
    }

    /**
     * @return ImageCreateResourceFilterInterface
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
        $result = new UploaderModel();

        try {
            foreach ($this->getDataResourceCreator()->getResources() as $resource) {
                $this->saveService->save($resource);
                $result->addResource($resource);
            }

            $result->success();
        } catch (\Exception $e) {
            $result->fail();
        }

        $e->setResult($result);
    }
}
