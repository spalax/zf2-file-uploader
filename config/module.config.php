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

    'view_manager' => array(
        'strategies' => array(
            'Zf2Libs\View\Strategy\UploaderStrategy'
        )
    )
);
