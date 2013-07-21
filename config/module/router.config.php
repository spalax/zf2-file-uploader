<?php
return array(
    'routes' => array(
        'uploader' => array(
            'type' => 'literal',
            'options' => array(
                'route' => '/uploader'
            ),
            'may_terminate' => false,
            'child_routes' => array (
                'list' => array(
                    'type' => 'method',
                    'options' => array(
                        'verb' => 'get',
                        'defaults' => array(
                            'controller' => 'Zf2FileUploader\Controller\Images\ListController'
                        )
                    )
                ),
                'create' => array(
                    'type' => 'method',
                    'options' => array(
                        'verb' => 'post',
                        'defaults' => array(
                            'controller' => 'Zf2FileUploader\Controller\Images\CreateController'
                        )
                    )
                ),
                'remove' => array(
                    'type' => 'method',
                    'options' => array(
                        'verb' => 'delete',
                        'defaults' => array(
                            'controller' => 'Zf2FileUploader\Controller\Images\RemoveController'
                        )
                    )
                )
            )
        )
    )
);
