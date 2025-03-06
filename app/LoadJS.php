<?php

declare(strict_types=1);

namespace App\PhpSSE;

class LoadJS
{
    private string $path;
    private string $filename;

    public static function make(): LoadJS
    {
        return new self();
    }

    public function path(string $path): LoadJS
    {
        $this->path = $path;
        return $this;
    }

    public function filename(string $filename): LoadJS
    {
        $this->filename = $filename;
        return $this;
    }

    public function load(): string
    {
        $path = $this->path ?? dirname(__DIR__) . '/app/Js';
        return file_get_contents(
            $path . DIRECTORY_SEPARATOR
            . $this->filename . '.js') ?? '';
    }
}
