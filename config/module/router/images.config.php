<?php
return array(
    'type' => 'literal',
    'options' => array(
        'route' => '/images'
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
        'image' => array(
            'type' => 'segment',
            'options' => array(
                'route' => '/:token',
                'constraints' => array( 'token' => '[a-zA-Z0-9]{45}' )
            ),
            'may_terminate' => false,
            'child_routes' => array(
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