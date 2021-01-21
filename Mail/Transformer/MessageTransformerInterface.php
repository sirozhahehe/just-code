<?php

namespace Bodyshops\AppBundle\Mail\Transformer;

use Bodyshops\AppBundle\Mail\ReadableMessage;

interface MessageTransformerInterface
{
    /**
     * Transform a Message
     *
     * @param ReadableMessage $message
     * @return mixed
     */
    public function transformMessage(ReadableMessage $message);
}