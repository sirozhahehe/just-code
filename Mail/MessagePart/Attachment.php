<?php

namespace Bodyshops\AppBundle\Mail\MessagePart;

/**
 * Class Attachment
 * @package Bodyshops\AppBundle\Mail\MessagePart
 */
class Attachment
{
    /** @var string|null */
    private $content;

    /** @var string|null */
    private $mimeType;

    /** @var string|null */
    private $filename;

    /**
     * Attachment constructor.
     * @param string $content
     * @param string $mimeType
     * @param string $filename
     */
    public function __construct($content, $mimeType, $filename)
    {
        $this->filename = $filename;
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

    /**
     * @return string|null
     */
    public function getFilename()
    {
        return $this->filename;
    }

}