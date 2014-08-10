<?php

return [
    'component' => [
        'cache' => [
            'class' => function_exists('apc_store') ? 'hikari\cache\Apc' : 'hikari\cache\Memory',
            'options' => [
                'shared' => true,
                'register' => true,
            ],
        ],
        'html' => [
            'class' => 'hikari\html\Html',
            'options' => [
                'shared' => true,
                'register' => true,
            ],
        ],
        'view' => [
            'class' => 'hikari\view\View',
            'options' => [
                'components' => [
                    'asset',
                    'cache',
                    'html',
                    'router',
                    //'translator',
                ],
            ],
            'properties' => [
                'extensions' => ['phtml'],
            ],
        ],
        'asset' => [
            'class' => 'hikari\asset\Asset',
            'options' => [
                'components' => [
                    'cache',
                ],
            ],
        ],
        'router' => [
            'class' => 'hikari\router\Router',
            'options' => [
                'shared' => true,
                'components' => [
                    'cache',
                ],
            ],
            'properties' => [
                /**
                 * All routes are grouped into a named category, this name is used when an URI is built.
                 * Names do not affect how routes are processed (first to last).
                 */
                'routes' => [
                    'index' => [
                        'format' => '/',
                        'target' => ['app\controller\Index', 'action' => 'index'],
                    ],
                    /*'testmodule' => [
                        'format' => [
                            '/testmodule',
                            '/testmodule/:controller/:action',
                            '/testmodule/:controller/:action/:id[d+]' => ['@testmodule\:controller', 'test' => 'testing'], // Use specific rule for this match
                        ],
                        'target' => ['@testmodule\:controller', 'action' => 'index'],
                    ],
                    'testregex' => [
                        'regexp' => '/\/testregex\/(?<controller>[\w]+)\/(?<action>[\w+])/',
                        'target' => ['@testregex\:controller', 'action' => 'index'],
                    ],
                    'testmoduleforward' => [
                        'format' => '/testmoduleforward',
                        'target' => ['@testmoduleforward\Index', 'action' => 'index'],
                        'import' => 'testmodule',
                    ],*/
                    'bitbucket' => [
                        'format' => [
                            ['host' => 'bitbucket.org', 'path' => '/:user/:repo'],
                        ],
                        'target' => ['user' => 'metrica', 'repo' => 'hikari-lib'],
                    ],
                    'default' => [
                        'format' => [
                            '/:class/:action/:id',
                            '/:class/:action',
                            '/:class',
                        ],
                        'target' => ['app\controller\:Class', 'action' => 'index', 'id' => null],
                    ],
                ],
            ],
        ],
        'request' => [
            'class' => 'hikari\http\Request',
            'options' => [
                'shared' => true,
            ],
        ],
        'response' => [
            'class' => 'hikari\http\Response',
            'options' => [
                'shared' => true,
            ],
        ],
        'action' => [
            'class' => 'hikari\controller\Action',
        ],
    ],
];
