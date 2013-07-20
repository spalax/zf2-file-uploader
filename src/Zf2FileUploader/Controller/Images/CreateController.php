<?php
namespace Zf2FileUploader\Controller\Images;

use Zf2FileUploader\Controller\AbstractCreateController;
use Zend\Mvc\MvcEvent;
use Zf2FileUploader\InputData\ResourceDataInterface;

class CreateController extends AbstractCreateController
{
    public function __construct(ResourceDataInterface $createResourceData)
    {

    }

    public function onDispatch(MvcEvent $e)
    {

    }
}
