<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Server sent events
|--------------------------------------------------------------------------
|
|
*/
return [
    'header' => [
        'content-type' => 'Content-Type: text/event-stream',
        'cache-control' =>'Cache-Control: no-cache',
        'connection' => 'Connection: keep-alive',
    ],
    'toast' => [
        'height' => '3.675rem',
        'width' => '9rem',
        'position' => 'top',
        'time' => 500
    ],
    'progressbar' => [
        'height' => '3.675rem',
        'width' => '9rem',
        'position' => 'top',
        'initialize_percent' => 0,
    ]
];
