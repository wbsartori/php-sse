<?php

declare(strict_types=1);

namespace App\PhpSSE\Notifications\Interfaces;

interface NotificationsInterface
{
    public function title(string $title): NotificationsInterface;
    public function message(string $message): NotificationsInterface;
    public function send();
}
