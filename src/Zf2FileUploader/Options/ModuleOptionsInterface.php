<?php
namespace Zf2FileUploader\Options;

interface ModuleOptionsInterface extends TemporaryCleanerOptionsInterface,
                                         PreviewOptionsInterface,
                                         InputValidatorOptionsInterface,
                                         PersisterOptionsInterface,
                                         ImageResourceOptionsInterface {}
