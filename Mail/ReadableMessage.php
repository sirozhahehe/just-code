<?php

namespace Bodyshops\AppBundle\Mail;

use Bodyshops\AppBundle\Mail\MessagePart\Attachment;
use Bodyshops\AppBundle\Mail\MessagePart\Bcc;
use Bodyshops\AppBundle\Mail\MessagePart\Content;
use Bodyshops\AppBundle\Mail\MessagePart\From;
use Bodyshops\AppBundle\Mail\MessagePart\To;

interface ReadableMessage
{
    /** @return From */
    public function getFrom();

    /** @return string|null */
    public function getSubject();

    /** @return To[] */
    public function getTos();

    /** @return Bcc[] */
    public function getBccs();

    /** @return Content[] */
    public function getContents();

    /** @return Attachment[] */
    public function getAttachments();

    /** @return string|null */
    public function getType();
}