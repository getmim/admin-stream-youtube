<?php

return [
    '__name' => 'admin-stream-youtube',
    '__version' => '0.0.1',
    '__git' => 'git@github.com:getmim/admin-stream-youtube.git',
    '__license' => 'MIT',
    '__author' => [
        'name' => 'Iqbal Fauzi',
        'email' => 'iqbalfawz@gmail.com',
        'website' => 'http://iqbalfn.com/'
    ],
    '__files' => [
        'modules/admin-stream-youtube' => ['install','update','remove'],
        'theme/admin/stream/youtube' => ['install','update','remove']
    ],
    '__dependencies' => [
        'required' => [
            [
                'admin' => NULL
            ],
            [
                'lib-form' => NULL
            ],
            [
                'lib-formatter' => NULL
            ],
            [
                'stream-youtube' => NULL
            ],
            [
                'admin-site-meta' => NULL
            ]
        ],
        'optional' => []
    ],
    'autoload' => [
        'classes' => [
            'AdminStreamYoutube\\Controller' => [
                'type' => 'file',
                'base' => 'modules/admin-stream-youtube/controller'
            ]
        ],
        'files' => []
    ],
    'routes' => [
        'admin' => [
            'adminStreamYoutubeEdit' => [
                'path' => [
                    'value' => '/stream/youtube'
                ],
                'method' => 'GET|POST',
                'handler' => 'AdminStreamYoutube\\Controller\\Stream::edit'
            ]
        ]
    ],
    'adminUi' => [
        'sidebarMenu' => [
            'items' => [
                'stream' => [
                    'label' => 'Stream',
                    'icon' => '<i class="fas fa-calendar-week"></i>',
                    'priority' => 0,
                    'children' => [
                        'youtube' => [
                            'label' => 'Youtube',
                            'icon' => '<i></i>',
                            'route' => ['adminStreamYoutubeEdit'],
                            'perms' => 'manage_stream_youtube'
                        ]
                    ]
                ]
            ]
        ]
    ],
    'libForm' => [
        'forms' => [
            'admin.stream-youtube.edit' => [
                '@extends' => ['std-site-meta'],
                'title' => [
                    'label' => 'Title',
                    'type' => 'text',
                    'rules' => [
                        'required' => TRUE
                    ]
                ],
                'content' => [
                    'label' => 'About',
                    'type' => 'summernote',
                    'rules' => []
                ],
                'embed' => [
                    'label' => 'Embed',
                    'type' => 'textarea',
                    'rules' => []
                ],
                'meta-schema' => [
                    'options' => [
                        'BroadcastEvent' => 'BroadcastEvent'
                    ]
                ]
            ]
        ]
    ]
];