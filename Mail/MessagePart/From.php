<?php

namespace Bodyshops\AppBundle\Mail\MessagePart;

/**
 * Class From
 * @package Bodyshops\AppBundle\Mail\MessagePart
 */
class From
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