<?php
namespace Zf2FileUploader\View\Model\Exception;

use Zf2FileUploader\Exception\ExceptionInterface;

class InvalidArgumentException extends \InvalidArgumentException implements ExceptionInterface {}