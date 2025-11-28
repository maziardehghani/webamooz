<?php

return [
    'MediaTypeServices' =>
    [



        'image' => [

            'extension' =>
                [
                    'jpg',
                    'jpeg',
                    'png'
                ],


            'handler' => \Modules\Media\Services\imageFileServices::class,
        ],




        'video' => [

            'extension' =>
                [
                    'mp4',
                    'mkv',
                    'avi',
                    'MOV',
                ],

            'handler' =>

                    \Modules\Media\Services\videoFileServices::class,

        ]
    ]
];
