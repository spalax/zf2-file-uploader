<?php
return array(
    'Zf2FileUploader\Options\TemporaryCleanerOptionsInterface' =>
        'Zf2FileUploader\Options\ModuleOptions',
    'Zf2FileUploader\Options\InputValidatorOptionsInterface' =>
        'Zf2FileUploader\Options\ModuleOptions',
    'Zf2FileUploader\Options\ResourceOptionsInterface' =>
        'Zf2FileUploader\Options\ModuleOptions',
    'Zf2FileUploader\Options\ImageResourceOptionsInterface' =>
        'Zf2FileUploader\Options\ModuleOptions',
    'Zf2FileUploader\I18n\Translator\TranslatorInterface' =>
        'Zf2FileUploader\I18n\Translator\Translator',
    'Zf2FileUploader\InputData\ImageResourceDataInterface' =>
        'Zf2FileUploader\InputData\CreateImageResourceData',
    'Zf2FileUploader\Resource\AbstractFactory\ResourceInterface' =>
        'Zf2FileUploader\Resource\AbstractFactory\Resource',
    'Zf2FileUploader\Service\Resource\Image\SaveServiceInterface' =>
        'Zf2FileUploader\Service\Resource\Image\SaveService',
    'Zf2FileUploader\Service\Resource\Image\DecorateServiceInterface' =>
        'Zf2FileUploader\Service\Resource\Image\DecorateService',
    'Zend\EventManager\EventManagerInterface' =>
        'EventManager',
    'Zend\ServiceManager\ServiceLocatorInterface' =>
        'ServiceManager'
);