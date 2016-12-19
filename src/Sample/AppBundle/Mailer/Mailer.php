<?php

namespace Sample\AppBundle\Mailer;

use Sample\AppBundle\Mailer\Provider\MailerProviderInterface;
use Sample\Domain\Event\EmailSentEvent;
use Sample\Domain\Mail\Message;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class Mailer
{
    /**
     * @var string
     */
    private $sender;

    /**
     * @var string
     */
    private $receiver;

    /**
     * @var MailerProviderInterface
     */
    private $provider;

    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    /**
     * @param string                   $sender
     * @param string                   $receiver
     * @param MailerProviderInterface  $provider
     * @param EventDispatcherInterface $provider
     */
    public function __construct(
        string $sender,
        string $receiver,
        MailerProviderInterface $provider,
        EventDispatcherInterface $dispatcher
    ) {
        $this->sender = $sender;
        $this->receiver = $receiver;
        $this->provider = $provider;
        $this->dispatcher = $dispatcher;
    }

    /**
     * Send email.
     *
     * @param string $subject
     * @param string $content
     */
    public function send(string $subject, string $content)
    {
        $message = new Message(
            $this->sender,
            $this->receiver,
            $subject,
            $content
        );

        $this->provider->send($message);
        $this->dispatcher->dispatch(
            EmailSentEvent::NAME,
            new EmailSentEvent($message)
        );
    }
}
