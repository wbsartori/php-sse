<?php

declare(strict_types=1);

namespace App\PhpSSE;

class EventSource
{
    private string $url = '';
    private array $params = [];

    public function __construct(string $url, array $params = [])
    {
        $this->url = $url;
        $this->params = $params;
    }


    public function exec(): void
    {
        $this->event2();
    }

    private function event(): void
    {
        header('Content-Type: text/html; charset=UTF-8');

        // Criação da div
        $event = '<div id="' . htmlspecialchars($this->params['id']) . '"></div>';

        // Código JavaScript usando heredoc para melhor legibilidade
        $event .= <<<HTML
        <script defer>
            document.addEventListener("DOMContentLoaded", function() {
                const url = "{$this->url}";
                const eventSource = new EventSource(url);
                eventSource.onmessage = function(event) {
                    try {
                        const data = JSON.parse(event.data);
                        console.log("Nova mensagem SSE:", data);
                    } catch (error) {
                        console.error("Erro ao processar mensagem SSE:", error);
                    }
                };    
                eventSource.onerror = function(event) {
                    console.error("Erro na conexão SSE:", event);
                    eventSource.close();
                };
            });
        </script>
        HTML;

        echo $event;
    }

    private function event2(): void
    {
        header('Content-Type: text/html; charset=UTF-8');
        $loadBootstrapJS = LoadJS::make()->filename('load-bootstrap')->load();
        $notificationJS = LoadJS::make()->filename('notification')->load();
        $progressBarJS = LoadJS::make()->filename('progress-bar')->load();
        $event = '<div id="' . htmlspecialchars($this->params['id']) . '" data-url="' . htmlspecialchars($this->url) . '"></div>';
        $event .= '<script defer>'. $loadBootstrapJS .'</script>';
        $event .= '<script defer>'. $notificationJS. '</script>';
        $event .= '<script defer>'. $progressBarJS. '</script>';
        echo $event;
    }

}
