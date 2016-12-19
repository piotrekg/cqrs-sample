<?php

namespace Sample\AppBundle\Mailer\Provider;

use Sample\AppBundle\Mailer\Mailer;
use Sample\Domain\Mail\Message;

class SwiftMailerProvider implements MailerProviderInterface
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @param \Swift_Mailer $mailer
     */
    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * {@inheritdoc}
     */
    public function send(Message $message)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject($message->getSubject())
            ->setFrom($message->getSender())
            ->setTo($message->getReceiver())
            ->setBody(
                $message->getContent(),
                'text/plain'
            )
        ;

        $this->mailer->send($message);
    }
}
