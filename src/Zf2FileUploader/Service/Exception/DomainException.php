<?php
namespace Zf2FileUploader\Service\Exception;

use Zf2FileUploader\Exception\ExceptionInterface;

class DomainException extends \InvalidArgumentException implements ExceptionInterface {}