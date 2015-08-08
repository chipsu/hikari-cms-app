<?php

return [
    'component' => [
        'controller' => [
            #'filters' => [
            #],
        ],
        'cache' => [
            'class' => function_exists('apc_store') ? 'hikari\cache\Apc' : 'hikari\cache\Memory',
            'shared' => true,
            'register' => true,
        ],
        'html' => [
            'class' => 'hikari\html\Html',
            'shared' => true,
            'register' => true,
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
            'shared' => true,
            'register' => true,
            'components' => [
                'html',
            ],
        ],
        'view' => [
            'class' => 'hikari\view\View',
            'components' => [
                'asset',
                'cache',
                'html',
                'router',
                //'translator',
                'menu',
                //'widget',
            ],
            'extensions' => ['htpl', 'phtml'],
            'compilers' => [
                'htpl' => '\hikari\view\compiler\Htpl2Compiler',
            ],
            'paths' => [
                '@app/themes/@role',
                '@lib/hikari-cms/themes/@role',
                '@app',
                '@lib/hikari-cms',
            ],
        ],
        'asset' => [
            'class' => 'hikari\asset\Asset',
            'components' => [
                'cache',
            ],
        ],
        'router' => [
            'class' => 'hikari\router\Router',
            'shared' => true,
            'cachePrefix' => null,
            'components' => [
                'cache',
            ],
            'paramMap' => [
                'controller' => [
                    'post' => 'hikari\cms\controller\:Controller',
                    '*' => 'hikari\cms\controller\:Controller',
                ],
            ],
            'defaultParams' => [
                'controller' => 'index',
                'action' => 'index',
            ],
            /**
             * Route v2
             */
            'groups' => [
                'api' => [
                    ['/:controller/:id', 'head,get', ['id' => null]],
                    ['/:controller/:id/:method', 'head,get,post', ['id' => null, 'method' => null]],
                    ['/:controller/:id', '@rest', ['id' => null]],
                    'paramMap' => [
                        'controller' => [
                            '*' => '\app\controller\:Controller',
                        ],
                        'action' => [
                            '*' =>  ':method',
                        ],
                    ],
                ],
                'home' => [
                    ['/', 'head,get', []],
                ],
                /*'api' => [
                    'match' => [
                        '@rest/:controller/:id',
                        '@get/:controller/:id/:action',
                        '@get/:controller/:id',
                        '@get/:controller',
                        ['method' => '@get', 'format' => '/:controller'],
                        '@get' => '/:controller',
                    ],
                    'target' => ['controller' => 'post', 'id' => null, 'action' => ':method'],
                    'get' => ['target...'],
                    'post,put' => ['target...'],
                ],*/
            ],
            /**
             * All routes are grouped into a named category, this name is used when an URI is built.
             * Names do not affect how routes are processed (first to last).
             */
            'routes_OLD' => [
                'index' => [
                    'format' => '/',
                    'target' => ['app\controller\Index', 'action' => 'index'],
                ],
                'post' => [
                    'format' => [
                        '/post/:id/:action',
                        '/post/:id',
                        '/post',
                    ],
                    'target' => ['hikari\cms\controller\Post', 'id' => null, 'action' => 'read'],
                ],
                'post_read' => [
                    'format' => ['/post/:id'],
                    'target' => ['hikari\cms\controller\Post', 'action' => 'read'],
                ],
                'post_remove' => [
                    'format' => ['/post/:id/remove'],
                    'target' => ['hikari\cms\controller\Post', 'action' => 'read'],
                ],
                'rest' => [
                    'format' => [
                        ['path' => '/rest/:class/:id'],
                        ['path' => '/rest/:class'],
                    ],
                    'target' => ['hikari\cms\controller\:Class', 'class' => 'post'],
                    'method' => ['head', 'options', 'get', 'put', 'post', 'patch', 'delete'],
                ],
                'post2' => [
                    'format' => [
                        ['path' => '/post2/:class/:id/:action'],
                        ['path' => '/post2/:class/:id'],
                        ['path' => '/post2/:class'],
                    ],
                    'target' => ['hikari\cms\controller\:Class', 'class' => 'post', 'action' => 'index'],
                ],
                'admin' => [
                    'format' => [
                        '/admin/:class/:action/:id',
                        '/admin/:class/:action',
                        '/admin/:action',
                        '/admin',
                    ],
                    'target' => ['hikari\cms\controller\Admin', 'class' => 'admin', 'action' => 'index', 'id' => null],
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
        'request' => [
            'class' => 'hikari\http\Request',
            'shared' => true,
        ],
        'response' => [
            'class' => 'hikari\http\Response',
            'shared' => true,
        ],
        'action' => [
            'class' => 'hikari\core\Action',
        ],
        /*'script' => [
            'class' => 'hikari\html\script',
            'packages' => [
                'jquery' => [
                    'js' => ['//code.jquery.com/jquery-2.1.0.min.js'],
                    'depends' => [],
                ],
            ],
        ],*/
    ],
];
