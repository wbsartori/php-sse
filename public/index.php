<?php

declare(strict_types=1);

use App\PhpSSE\Notifications\Notification;

require_once dirname(__DIR__) . '/vendor/autoload.php';

Notification::make('teste.php')
    ->title('Titulo da mensagem')
    ->message('Processado com sucesso')
    ->success()
    ->send();
