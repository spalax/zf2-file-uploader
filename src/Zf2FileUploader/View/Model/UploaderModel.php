<?php
namespace Zf2FileUploader\View\Model;

use Zend\View\Model\ViewModel;
use Zend\Json\Json;
use Zend\I18n\Translator\Translator;

abstract class UploaderModel extends ViewModel
{
    /**
     * Uploader model is usually terminal
     *
     * @var bool
     */
    protected $terminate = true;
}
