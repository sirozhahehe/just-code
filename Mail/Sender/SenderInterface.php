<?php

namespace Bodyshops\AppBundle\Mail\Sender;

use Bodyshops\AppBundle\Mail\ReadableMessage;

interface SenderInterface
{
    /**
     * Sends a message
     *
     * @param ReadableMessage $message
     * @return mixed
     */
    public function send(ReadableMessage $message);
}