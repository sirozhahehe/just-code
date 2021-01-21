<?php

namespace Bodyshops\AppBundle\Mail\Sender;

use Bodyshops\AppBundle\Mail\ReadableMessage;
use Bodyshops\AppBundle\Mail\Transformer\MessageTransformerInterface;
use Bodyshops\AppBundle\Service\Wrapper\SendGridClientWrapper;

class SendGridSender implements SenderInterface
{
    /** @var MessageTransformerInterface */
    private $transformer;

    /** @var SendGridClientWrapper */
    private $sendGridClient;

    /**
     * SendGridSender constructor.
     * @param MessageTransformerInterface $transformer
     * @param SendGridClientWrapper $sendGridClient
     */
    public function __construct(MessageTransformerInterface $transformer, SendGridClientWrapper $sendGridClient)
    {
        $this->transformer    = $transformer;
        $this->sendGridClient = $sendGridClient;
    }

    /**
     * @param ReadableMessage $message
     */
    public function send(ReadableMessage $message): void
    {
        $transformedMessage = $this->transformer->transformMessage($message);

        $this->sendGridClient->send($transformedMessage, $message->getType());
    }

}