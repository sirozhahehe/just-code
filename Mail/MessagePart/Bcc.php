<?php

namespace Bodyshops\AppBundle\Mail\MessagePart;

/**
 * Class Bcc
 * @package Bodyshops\AppBundle\Mail\MessagePart
 */
class Bcc
{
    /** @var string|null */
    private $address;

    /** @var string|null */
    private $name;

    /**
     * From constructor.
     * @param string $address
     * @param string|null $name
     */
    public function __construct($address, $name = null)
    {
        $this->address = $address;
        $this->name    = $name;
    }

    /**
     * @return string|null
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }
}