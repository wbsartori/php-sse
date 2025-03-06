<?php

declare(strict_types=1);

$config = require dirname(__DIR__) . '/config/phpsse.php';

header($config['header']['content-type']);
header($config['header']['cache-control']);
header($config['header']['connection']);

$messages = [
    "Item 1 processado",
    "Item 2 processado",
    "Item 3 processado",
    "Item 4 processado",
    "Item 5 processado"
];

foreach ($messages as $message) {
    echo "data: " . json_encode(["message" => $message, "finished" => false]) . "\n\n";
    ob_flush();
    flush();
    sleep(2);
}

echo "data: " . json_encode(["message" => "Processamento finalizado", "finished" => true]) . "\n\n";
ob_flush();
flush();


//header('Content-Type: text/event-stream');
//header('Cache-Control: no-cache');
//header('Connection: keep-alive');
//
//$messages = [
//    "Mensagem 1: Olá, cliente!",
//    "Mensagem 2: SSE está funcionando.",
//    "Mensagem 3: Atualização em tempo real."
//];
//
//$i = 0;
//while (true) {
//    echo "data: " . json_encode(["message" => $messages[$i % count($messages)]]) . "\n\n";
//    ob_flush();
//    flush();
//    sleep(2); // Envia uma mensagem a cada 2 segundos
//    $i++;
//}



