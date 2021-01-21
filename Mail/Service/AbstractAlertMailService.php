<?php

namespace Bodyshops\AppBundle\Mail\Service;

use Bodyshops\AppBundle\Mail\Message;
use Bodyshops\AppBundle\Mail\Sender\SenderInterface;
use Bodyshops\AppBundle\Object\ShopAlertTypeDTO;
use Bodyshops\ShopBundle\Entity\Alert;
use Bodyshops\ShopBundle\Service\AlertService;

abstract class AbstractAlertMailService implements AlertMailServiceInterface
{
    /** @var SenderInterface */
    protected $sender;

    /**
     * AlertMailService constructor.
     * @param SenderInterface $sender
     */
    public function __construct(SenderInterface $sender)
    {
        $this->sender       = $sender;
    }

    /**
     * @param Alert $alert
     * @param ShopAlertTypeDTO $alertTypeDTO
     */
    public function sendAlertEmail(Alert $alert, ShopAlertTypeDTO $alertTypeDTO): void
    {
        $message = new Message();
        $message
            ->setSubject('Alert From ' . $alertTypeDTO->getShop()->getDescription())
            ->setFrom($alertTypeDTO->getShop()->getAddress()->getEmail(), $alertTypeDTO->getShop()->getDescription())
            ->setType('Alert Message Type');

        foreach (array_unique(explode(',', $alertTypeDTO->getEmails())) as $email) {
            $message->addTo($email);
        }

        $htmlBody  = $this->getHtmlContent($alert, $alertTypeDTO);
        $plainBody = $this->getPlainContent($alert, $alertTypeDTO);


        $message
            ->addContent($htmlBody, 'text/html')
            ->addContent($plainBody, 'text/plain');

        $this->sender->send($message);
    }


    /**
     * @param Alert $alert
     * @param ShopAlertTypeDTO $alertTypeDTO
     * @return string
     */
    abstract protected function getPlainContent(Alert $alert, ShopAlertTypeDTO $alertTypeDTO): string;

    /**
     * @param Alert $alert
     * @param ShopAlertTypeDTO $alertTypeDTO
     * @return string
     */
    abstract protected function getHtmlContent(Alert $alert, ShopAlertTypeDTO $alertTypeDTO): string;

}