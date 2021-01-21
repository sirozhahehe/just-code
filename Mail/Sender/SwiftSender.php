<?php

namespace Bodyshops\AppBundle\Mail\Sender;

use Bodyshops\AppBundle\Exception\NotImplementedException;
use Bodyshops\AppBundle\Mail\ReadableMessage;
use Bodyshops\AppBundle\Mail\Transformer\MessageTransformerInterface;

class SwiftSender implements SenderInterface
{
    /** @var MessageTransformerInterface */
    private $transformer;

    public function __construct(MessageTransformerInterface $transformer)
    {
        $this->transformer = $transformer;
    }

    public function send(ReadableMessage $message)
    {
        throw new NotImplementedException('Method not implemented yet.');
    }
}