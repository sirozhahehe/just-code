<?php

namespace Bodyshops\AppBundle\Mail;

use Bodyshops\AppBundle\Mail\MessagePart\Attachment;
use Bodyshops\AppBundle\Mail\MessagePart\Bcc;
use Bodyshops\AppBundle\Mail\MessagePart\Content;
use Bodyshops\AppBundle\Mail\MessagePart\From;
use Bodyshops\AppBundle\Mail\MessagePart\To;

/**
 * Class Message
 * @package Bodyshops\AppBundle\Mail
 *
 * If this class has not enough methods/data - feel free to update it and interfaces.
 */
final class Message implements WritableMessage, ReadableMessage
{
    /** @var string|null */
    private $subject;

    /** @var From */
    private $from;

    /** @var To[] */
    private $tos = [];

    /** @var Bcc[] */
    private $bccs = [];

    /** @var Content[] */
    private $contents = [];

    /** @var Attachment[] */
    private $attachments = [];

    /** @var string|null */
    private $type;

    /** {@inheritDoc} */
    public function addTo($address, $name = null)
    {
        $to = new To($address, $name);

        $this->tos[] = $to;
        return $this;
    }

    /** {@inheritDoc} */
    public function addContent($content, $mimeType)
    {
        $content = new Content($content, $mimeType);

        $this->contents[] = $content;
        return $this;
    }

    /** {@inheritDoc} */
    public function addBcc($address, $name = null)
    {
        $bcc = new Bcc($address, $name);

        $this->bccs[] = $bcc;
        return $this;
    }

    /** {@inheritDoc} */
    public function addAttachment($content, $mimeType, $filename)
    {
        $attachment = new Attachment($content, $mimeType, $filename);

        $this->attachments[] = $attachment;
        return $this;
    }

    /** {@inheritDoc} */
    public function setFrom($address, $name = null)
    {
        $this->from = new From($address, $name);
        return $this;
    }

    /** {@inheritDoc} */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    /** {@inheritDoc} */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /** {@inheritDoc} */
    public function getType()
    {
        return $this->type;
    }

    /** {@inheritDoc} */
    public function getFrom()
    {
        return $this->from;
    }

    /** {@inheritDoc} */
    public function getSubject()
    {
        return $this->subject;
    }

    /** {@inheritDoc} */
    public function getTos()
    {
        return $this->tos;
    }

    /** {@inheritDoc} */
    public function getBccs()
    {
        return $this->bccs;
    }

    /** {@inheritDoc} */
    public function getContents()
    {
        return $this->contents;
    }

    /** {@inheritDoc} */
    public function getAttachments()
    {
        return $this->attachments;
    }

    public function resetTo()
    {
        $this->tos = [];
    }

    public function resetContent()
    {
        $this->contents = [];
    }
}