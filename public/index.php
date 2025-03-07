<?php

declare(strict_types=1);

use App\PhpSSE\Notifications\Notification;

require_once dirname(__DIR__) . '/vendor/autoload.php';


//$url = dirname(__DIR__) . '/public/teste.php';

Notification::make()
    ->title('Titulo da mensagem')
    ->message('Processado com sucesso')
    ->success()
    ->send();
