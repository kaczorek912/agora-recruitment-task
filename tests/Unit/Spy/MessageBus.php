<?php

declare(strict_types=1);

namespace App\Tests\Unit\Spy;

use Ds\Deque;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;

/**
 * @author Mateusz Kaczorowski <mateusz.kaczorowski@iiit.pl>
 */
class MessageBus implements MessageBusInterface
{
    public Deque $dispatchedMessages;
    public Deque $dispatchedMessagesStamps;

    public function __construct()
    {
        $this->dispatchedMessages = new Deque();
        $this->dispatchedMessagesStamps = new Deque();
    }

    public function dispatch($message, array $stamps = []): Envelope
    {
        $this->dispatchedMessages[] = $message;
        $this->dispatchedMessagesStamps[] = $stamps;

        return new Envelope($message, []);
    }
}
