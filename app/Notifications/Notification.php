<?php

declare(strict_types=1);

namespace App\PhpSSE\Notifications;

use App\PhpSSE\EventSource;
use Exception;
use App\PhpSSE\Events\Event;
use App\PhpSSE\Events\Interfaces\EventsSseInterface;
use App\PhpSSE\Notifications\Interfaces\NotificationsInterface;

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

    public static function make(string $url = null)
    {
        if ($url !== null) {
            self::$url = $url;
        }
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
        $eventSource = new EventSource(self::$url, [
            'type' => $this->type(),
            'url' => self::$url ?? '',
            'title' => $this->title ?? '',
            'message' => $this->message ?? '',
            'event' => self::$event,
        ]);
        $eventSource->exec();
    }
}
