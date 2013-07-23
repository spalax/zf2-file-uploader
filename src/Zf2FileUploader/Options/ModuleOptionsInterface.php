<?php
namespace Zf2FileUploader\Options;

use Zf2FileUploader\Options\Resource\Decorator;

interface ModuleOptionsInterface extends TemporaryCleanerOptionsInterface,
                                         PreviewOptionsInterface,
                                         InputValidatorOptionsInterface,
                                         ResourceOptionsInterface,
                                         ImageResourceOptionsInterface,
                                         Decorator\ResizerOptionsInterface,
                                         Decorator\ThumbnailerOptionsInterface{}
