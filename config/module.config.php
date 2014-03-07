<?php
namespace Zf2FileUploader;

return array(
    'router' => include __DIR__ . '/module/router.config.php',
    'controller_plugins' => array(
        'invokables' => array(
            'Params' => 'Zf2Libs\Mvc\Controller\Plugin\Params'
        )
    ),

    'di' => include __DIR__ . '/module/di.config.php',

    'zf2fileuploader' => array(

    ),

    'doctrine' => array(
        'driver' => array(
            'front_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/Zf2FileUploader/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Zf2FileUploader\Entity' => 'front_driver'
                )
            )
        )
    ),

    'view_manager' => array(
        'strategies' => array(
            'Zf2Libs\View\Strategy\UploaderStrategy'
        )
    )
);
