<?php

namespace Bodyshops\AppBundle\Mail;

/**
 * Interface WritableMessage
 * @package Bodyshops\AppBundle\Mail
 */
interface WritableMessage
{
    /**
     * @param string $address
     * @param string|null $name
     * @return $this
     */
    public function addTo($address, $name = null);

    /**
     * @param string $content
     * @param string $mimeType
     * @return $this
     */
    public function addContent($content, $mimeType);

    /**
     * @param string $address
     * @param string|null $name
     * @return $this
     */
    public function addBcc($address, $name = null);

    /**
     * @param string $content
     * @param string $mimeType
     * @param string $filename
     * @return $this
     */
    public function addAttachment($content, $mimeType, $filename);

    /**
     * @param string $address
     * @param string|null $name
     * @return $this
     */
    public function setFrom($address, $name = null);

    /**
     * @param $subject
     * @return $this
     */
    public function setSubject($subject);

    /**
     * @param string $type
     * @return $this
     */
    public function setType($type);
}