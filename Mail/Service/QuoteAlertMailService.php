<?php

namespace Bodyshops\AppBundle\Mail\Service;

use Bodyshops\AppBundle\Mail\Sender\SenderInterface;
use Bodyshops\AppBundle\Object\ShopAlertTypeDTO;
use Bodyshops\ShopBundle\Entity\Alert;
use Bodyshops\ShopBundle\Service\AlertService;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

class QuoteAlertMailService extends AbstractAlertMailService
{
    /** @var EngineInterface */
    private $twig;

    /**
     * QuoteAlertMailService constructor.
     * @param SenderInterface $sender
     * @param EngineInterface $twig
     */
    public function __construct(SenderInterface $sender, EngineInterface $twig)
    {
        parent::__construct($sender);
        $this->twig = $twig;
    }

    /**
     * @param Alert $alert
     * @param ShopAlertTypeDTO $alertTypeDTO
     * @return string
     */
    protected function getPlainContent(Alert $alert, ShopAlertTypeDTO $alertTypeDTO): string
    {
        $customer = $alert->getOrder()->getCustomer()->getAddress();

        $content = $alertTypeDTO->getTitle() ?? $alertTypeDTO->getDefaultTitle();
        $content .= ' ';
        $content .= $alertTypeDTO->getMessage();
        $content .= ' ';
        $content .= $customer->getFirstName() . ' - ' . $customer->getPhoneNumber();

        return $content;
    }

    /**
     * @param Alert $alert
     * @param ShopAlertTypeDTO $alertTypeDTO
     * @return string
     */
    protected function getHtmlContent(Alert $alert, ShopAlertTypeDTO $alertTypeDTO): string
    {
        $customer = $alert->getOrder()->getCustomer()->getAddress();

        $data = [
            'title'               => $alertTypeDTO->getTitle() ?? $alertTypeDTO->getDefaultTitle(),
            'message'             => $alertTypeDTO->getMessage() ?? $alertTypeDTO->getDefaultMessage(),
            'customerFirstName'   => $customer->getFirstName(),
            'customerPhoneNumber' => $customer->getPhoneNumber(),
        ];

        return $this->twig->render('@BodyshopsApp/Export/emails/quote_alert_mail.html.twig', $data);
    }
}