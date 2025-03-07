<?php

declare(strict_types=1);

namespace App\PhpSSE;

class EventSource
{
    private string $url = '';
    private array $params = [];

    public function __construct(array $params = [], string $url = '')
    {
        $this->url = $url;
        $this->params = $params;
    }


    public function exec(): void
    {
        $this->event();
    }

    private function event(): void
    {
        header('Content-Type: text/html; charset=UTF-8');
        $funcs = LoadJS::make()->filename('load-func')->load();
        $notificationID = 'notifications-' . htmlspecialchars($this->params['type']);
        $event = '<!DOCTYPE html>';
        $event .= '<html>';
        $event .= '<head>';
        $event .= '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>';
        $event .= '<script defer>' . $funcs . '</script>';
        $event .= '</head>';
        $event .= '<div id="' . $notificationID . '"></div>';
        $event .= '<script>notification("' . $notificationID . '", 5000, "'.$this->params['message'].'");</script>';
        $event .= '</html>';
        echo $event;
    }

}
