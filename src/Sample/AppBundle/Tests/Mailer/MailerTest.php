<?php

namespace Sample\AppBundle\Test\Mailer;

use PHPUnit\Framework\TestCase;
use Sample\AppBundle\Mailer\Mailer;
use Sample\AppBundle\Mailer\Provider\MailerProviderInterface;
use Sample\Domain\Mail\Message;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Prophecy\Argument;

class MailerTest extends TestCase
{
    public function testSendMail()
    {
        $message = new Message(
            'sender@example.com',
            'receiver@example.com',
            'subject',
            'content'
        );

        $provider = $this->prophesize(MailerProviderInterface::class);
        $eventDispatcher = $this->prophesize(EventDispatcher::class);

        $mailer = new Mailer(
            $message->getSender(),
            $message->getReceiver(),
            $provider->reveal(),
            $eventDispatcher->reveal()
        );

        $mailer->send($message->getSubject(), $message->getContent());

        $provider
            ->send(Argument::exact($message))
            ->shouldBeCalledTimes(1)
        ;
    }
}
