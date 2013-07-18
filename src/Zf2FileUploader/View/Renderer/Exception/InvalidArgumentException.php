<?php
namespace Zf2FileUploader\View\Renderer\Exception;

use Zf2FileUploader\Exception\ExceptionInterface;

class InvalidArgumentException extends \InvalidArgumentException implements ExceptionInterface {}