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
        /*'widget' => [
            'class' => 'hikari\component\Helper',
            'properties' => [
                'autoload' => [
                    'hikari\html\*',
                ],
                'components' => [
                    'html' => 'hikari\html\Html',
                    'menu' => 'hikari\html\Menu',
                    'grid' => 'hikari\html\Grid',
                    'list' => 'hikari\html\List',
                ],
            ],
        ],*/
        // i think this should be part of the html class? or at least autoload without having to specify it here?
        // See component/Helper
        'menu' => [
            'class' => 'hikari\html\Menu',
            'options' => [
                'shared' => true,
                'register' => true,
                'components' => [
                    'html',
                ],
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
                    'menu',
                    //'widget',
                ],
            ],
            'properties' => [
                'extensions' => ['htpl', 'phtml'],
                'compilers' => [
                    'htpl' => '\hikari\view\compiler\Htpl2Compiler',
                ],
                'paths' => [
                    __DIR__ . '/..',
                    __DIR__ . '/../../lib/hikari-cms',
                ],
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
                    'post' => [
                        'format' => [
                            '/post/:action/:id',
                            '/post/:action',
                        ],
                        'target' => ['hikari\cms\controller\Post', 'action' => 'index'],
                    ],
                    'admin' => [
                        'format' => [
                            '/admin/:class/:action/:id',
                            '/admin/:class/:action',
                            '/admin/:action',
                            '/admin',
                        ],
                        'target' => ['hikari\cms\controller\Admin', 'class' => 'admin', 'action' => null, 'id' => null],
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
        /*'script' => [
            'class' => 'hikari\html\script',
            'properties' => [
                'packages' => [
                    'jquery' => [
                        'js' => ['//code.jquery.com/jquery-2.1.0.min.js'],
                        'depends' => [],
                    ],
                ],
            ],
        ],*/
    ],
];
