<?php

declare(strict_types=1);

namespace App\PhpSSE\Events;

use App\PhpSSE\Events\Interfaces\EventsSseInterface;
use App\PhpSSE\Settings\Config;

class Event implements EventsSseInterface
{
    private string $id;
    private string $url;
    private array $addEventListener;


    public function __construct()
    {
        $config = Config::make()->getConfig();
        header($config['header']['content-type']);
        header($config['header']['cache-control']);
        header($config['header']['connection']);
    }

    public function id(string $id): EventsSseInterface
    {
        $this->id = $id;
        return $this;
    }

    public function url(string $url): EventsSseInterface
    {
        $this->url = $url;
        return $this;
    }

    public function addEventListener(string $event, callable $callback): EventsSseInterface
    {
        $this->addEventListener[$event] = $callback;
        return $this;
    }
}
