<?php

namespace Sample\Domain\Event;

use Sample\Domain\Mail\Message;
use Symfony\Component\EventDispatcher\Event;

class EmailSentEvent extends Event
{
    const NAME = 'email.sent';

    /**
     * @var Message
     */
    private $message;

    /**
     * @param Message $message
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * Gets the value of product.
     *
     * @return Message
     */
    public function getMessage() : Message
    {
        return $this->message;
    }
}
