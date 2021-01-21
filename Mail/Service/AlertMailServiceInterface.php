<?php

namespace Bodyshops\AppBundle\Mail\Service;

use Bodyshops\AppBundle\Object\ShopAlertTypeDTO;
use Bodyshops\ShopBundle\Entity\Alert;

interface AlertMailServiceInterface
{
    /**
     * @param Alert $alert
     * @param ShopAlertTypeDTO $alertTypeDTO
     */
    public function sendAlertEmail(Alert $alert, ShopAlertTypeDTO $alertTypeDTO);
}