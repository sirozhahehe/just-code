<?php

namespace Bodyshops\AppBundle\Mail\Service;

use Bodyshops\AppBundle\Mail\Sender\SenderInterface;
use Bodyshops\AppBundle\Object\ShopAlertTypeDTO;
use Bodyshops\ShopBundle\Entity\Alert;
use Bodyshops\ShopBundle\Service\AlertService;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

class OrderRelatedAlertMailService extends AbstractAlertMailService
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
        $order = $alert->getOrder();

        $content = $alertTypeDTO->getTitle() ?? $alertTypeDTO->getDefaultTitle();
        $content .= $alertTypeDTO->getMessage();
        $content .= ' RO#: ' . $order->getOrderNumber() . '. ';
        $content .= $order->getVehicleName();

        return $content;
    }

    /**
     * @param Alert $alert
     * @param ShopAlertTypeDTO $alertTypeDTO
     * @return string
     */
    protected function getHtmlContent(Alert $alert, ShopAlertTypeDTO $alertTypeDTO): string
    {
        $data = [
            'shop'    => $alert->getShop(),
            'message' => $alertTypeDTO->getMessage(),
            'title'   => $alertTypeDTO->getTitle() ?? $alertTypeDTO->getDefaultTitle(),
            'alert'   => $alert,
        ];

        return $this->twig->render('@BodyshopsApp/Export/emails/alert_mail.html.twig', $data);
    }
}