<?php
return array(
    'Zf2FileUploader\Options\TemporaryCleanerOptionsInterface' =>
        'Zf2FileUploader\Options\ModuleOptions',

    'Zf2FileUploader\Options\ResourceOptionsInterface' =>
        'Zf2FileUploader\Options\ModuleOptions',

    'Zf2FileUploader\Options\ImageResourceOptionsInterface' =>
        'Zf2FileUploader\Options\ModuleOptions',

    'Zf2FileUploader\I18n\Translator\TranslatorInterface' =>
        'Zf2FileUploader\I18n\Translator\Translator',

    'Zf2FileUploader\InputFilter\Image\CreateResourceInterface' =>
        'Zf2FileUploader\InputFilter\Image\CreateResource',

    'Zf2FileUploader\Input\Image\CreateResourceInterface' =>
        'Zf2FileUploader\Input\Image\CreateResource',

    'Zf2FileUploader\Resource\AbstractFactory\ResourceInterface' =>
        'Zf2FileUploader\Resource\AbstractFactory\Resource',

    'Zf2FileUploader\Resource\AbstractFactory\PersistedResourceInterface' =>
        'Zf2FileUploader\Resource\AbstractFactory\PersistedResource',

    'Zf2FileUploader\Service\Image\SaveServiceInterface' =>
        'Zf2FileUploader\Service\Image\SaveService',

    'Zf2FileUploader\Resource\Handler\Processor\ImageProcessorInterface' =>
        'Zf2FileUploader\Resource\Handler\Processor\Image\AggregateProcessor',

    'Zf2FileUploader\Service\Image\BindServiceInterface' =>
        'Zf2FileUploader\Service\Image\BindService',

    'Zf2FileUploader\Input\Image\LoadResourceInterface' =>
        'Zf2FileUploader\Input\Image\LoadResource\FromList',

    'Imagine\Image\ImagineInterface' =>
        'Imagine\Gd\Imagine',

    'Zend\EventManager\EventManagerInterface' =>
        'EventManager',

    'Zend\ServiceManager\ServiceLocatorInterface' =>
        'ServiceManager'
);