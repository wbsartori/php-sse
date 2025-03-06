<?php

declare(strict_types=1);

namespace Sartori\PhpSSE\Events\Interfaces;

interface EventsSseInterface
{
    public function id(string $id): EventsSseInterface;
    public function url(string $url): EventsSseInterface;
    public function addEventListener(string $event, callable $callback): EventsSseInterface;
}
