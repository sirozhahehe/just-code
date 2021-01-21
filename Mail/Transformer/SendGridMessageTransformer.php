<?php

namespace Bodyshops\AppBundle\Mail\Transformer;

use Bodyshops\AppBundle\Mail\ReadableMessage;
use SendGrid\Mail\Mail;

class SendGridMessageTransformer implements MessageTransformerInterface
{
    /**
     * @param ReadableMessage $message
     * @return Mail
     * @throws \SendGrid\Mail\TypeException
     */
    public function transformMessage(ReadableMessage $message)
    {
        $sendGridMessage = new Mail();

        $sendGridMessage->setFrom(
            $message->getFrom()->getAddress(),
            $message->getFrom()->getName()
        );
        $sendGridMessage->setSubject($message->getSubject());
        foreach ($message->getTos() as $to) {
            $sendGridMessage->addTo($to->getAddress(), $to->getName());
        }

        foreach ($message->getBccs() as $bcc) {
            $sendGridMessage->addBcc($bcc->getAddress(), $bcc->getName());
        }

        foreach ($message->getContents() as $content) {
            $sendGridMessage->addContent($content->getMimeType(), $content->getContent());
        }

        foreach ($message->getAttachments() as $attachment) {
            $sendGridMessage->addAttachment($attachment->getContent(), $attachment->getMimeType(), $attachment->getFilename());
        }

        return $sendGridMessage;
    }
}