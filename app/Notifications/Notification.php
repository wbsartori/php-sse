<?php

declare(strict_types=1);

namespace App\PhpSSE\Notifications;

use App\PhpSSE\LoadJS;
use Exception;
use App\PhpSSE\Events\Event;
use App\PhpSSE\Events\Interfaces\EventsSseInterface;

class Notification
{
    /**
     * @var EventsSseInterface|Event
     */
    private static EventsSseInterface $event;
    private static string $url;
    private string $title;
    private string $message;
    private string $success = '';
    private string $warning = '';
    private string $error = '';

    public static function make()
    {
        self::$event = new Event();
        return new self();
    }

    public function title(string $title)
    {
        $this->title = $title;
        return $this;
    }

    public function message(string $message)
    {
        $this->message = $message;
        return $this;
    }

    public function id(string $id): EventsSseInterface
    {
        return self::$event->id($id);
    }

    public function url(string $url): EventsSseInterface
    {
        return self::$event->url($url);
    }

    private function getSuccess(): string
    {
        return $this->success;
    }

    public function success(): Notification
    {
        $this->success = 'success';
        return $this;
    }

    private function getWarning(): string
    {
        return $this->warning;
    }

    public function warning(): Notification
    {
        $this->warning = 'warning';
        return $this;
    }

    private function getError(): string
    {
        return $this->error;
    }

    public function error(): Notification
    {
        $this->error = 'error';
        return $this;
    }


    private function type(): string
    {
        if($this->getSuccess() !== '') {
            return $this->getSuccess();
        }
        if($this->getWarning() !== '') {
            return $this->getWarning();
        }
        if($this->getError() !== '') {
            return $this->getError();
        }
        throw new Exception('No notification type defined');
    }

    public function send()
    {
        header('Content-Type: text/html; charset=UTF-8');
        $funcs = LoadJS::make()->filename('load-func')->load();
        $notificationID = 'notifications-' . htmlspecialchars($this->type());
        $event = '<!DOCTYPE html>';
        $event .= '<html>';
        $event .= '<head>';
        $event .= '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>';
        $event .= '<script defer>' . $funcs . '</script>';
        $event .= '</head>';
        $event .= '<div id="' . $notificationID . '"></div>';
        $event .= '<script>notification("' . $notificationID . '", 5000, "'.$this->message.'");</script>';
        $event .= '</html>';
        echo $event;
    }
}
