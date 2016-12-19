<?php

namespace Sample\AppBundle\Mailer\Provider;

use Sample\Domain\Mail\Message;

interface MailerProviderInterface
{
    /**
     * Send email.
     *
     * @param Message $message
     */
    public function send(Message $message);
}
