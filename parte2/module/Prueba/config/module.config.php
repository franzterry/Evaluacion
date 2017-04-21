<?php
return array(
    'router' => array(
        'routes' => array(
            'prueba' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/prueba',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Prueba\Controller',
                        'controller'    => 'Prueba',
                        'action'        => 'listar',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action[/:id]]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'         => '[a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Prueba' => __DIR__ . '/../view',
        ),
    ),
);