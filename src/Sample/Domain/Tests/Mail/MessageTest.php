<?php

namespace Sample\Domain\Tests\Mail;

use PHPUnit\Framework\TestCase;
use Sample\Domain\Mail\Message;

class MessageTest extends TestCase
{
    public function testConstructor()
    {
        $message = new Message(
            'sender@example.com',
            'receiver@example.com',
            'subject',
            'content'
        );

        $this->assertEquals('sender@example.com', $message->getSender());
        $this->assertEquals('receiver@example.com', $message->getReceiver());
        $this->assertEquals('subject', $message->getSubject());
        $this->assertEquals('content', $message->getContent());
    }
}
