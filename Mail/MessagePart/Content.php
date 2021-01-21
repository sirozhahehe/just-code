<?php

namespace Bodyshops\AppBundle\Mail\MessagePart;

/**
 * Class Content
 * @package Bodyshops\AppBundle\Mail\MessagePart
 */
class Content
{
    /** @var string|null */
    private $content;

    /** @var string|null */
    private $mimeType;

    /**
     * Content constructor.
     * @param string $content
     * @param string $mimeType
     */
    public function __construct($content, $mimeType)
    {
        $this->content  = $content;
        $this->mimeType = $mimeType;
    }

    /**
     * @return string|null
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return string|null
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }
}