<?php
namespace Zf2FileUploader\Controller\Images;

use Zf2FileUploader\Controller\AbstractCreateController;
use Zend\Mvc\MvcEvent;

class CreateController extends AbstractCreateController
{
    public function onDispatch(MvcEvent $e)
    {
//        \Zf2Libs\Debug\Utility::dump("on Dispatch");
    }
}
