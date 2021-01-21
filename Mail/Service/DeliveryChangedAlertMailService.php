<?php

namespace Bodyshops\AppBundle\Mail\Service;

use Bodyshops\AppBundle\Mail\Sender\SenderInterface;
use Bodyshops\AppBundle\Object\ShopAlertTypeDTO;
use Bodyshops\ShopBundle\Entity\Alert;
use Bodyshops\ShopBundle\Service\AlertService;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

class DeliveryChangedAlertMailService extends AbstractAlertMailService
{
    /** @var EngineInterface */
    private $twig;

    /** @var AlertService */
    private $alertService;

    /**
     * QuoteAlertMailService constructor.
     * @param SenderInterface $sender
     * @param AlertService $service
     * @param EngineInterface $twig
     */
    public function __construct(SenderInterface $sender, AlertService $service, EngineInterface $twig)
    {
        parent::__construct($sender);
        $this->twig         = $twig;
        $this->alertService = $service;
    }

    /**
     * @param Alert $alert
     * @param ShopAlertTypeDTO $alertTypeDTO
     * @return string
     */
    protected function getPlainContent(Alert $alert, ShopAlertTypeDTO $alertTypeDTO): string
    {
        $deliveryDiffDates = $this->alertService->getDeliveryDiffDates($alert->getOrder());

        $content = $alertTypeDTO->getTitle() ?? $alertTypeDTO->getDefaultTitle();
        $content .= $alertTypeDTO->getMessage();
        $content .= ' RO#: ' . $alert->getOrder()->getOrderNumber() . '. ';
        $content .= $alert->getOrder()->getVehicleName() . ' ';
        $content .= 'Total: $' . $alert->getOrder()->getTotal() / 100;
        $content .= ' ---';
        if ($deliveryDiffDates->getOldDeliveryDate()) {
            $content .= ' From ' . $deliveryDiffDates->getOldDeliveryDate()->format('m/d/Y');
        }
        $content .= ' to ' . $deliveryDiffDates->getNewDeliveryDate()->format('m/d/Y');
        $content .= ' ---' . $deliveryDiffDates->getDateDiffAsString();

        return $content;
    }

    /**
     * @param Alert $alert
     * @param ShopAlertTypeDTO $alertTypeDTO
     * @return string
     */
    protected function getHtmlContent(Alert $alert, ShopAlertTypeDTO $alertTypeDTO): string
    {
        $deliveryDiffDates = $this->alertService->getDeliveryDiffDates($alert->getOrder());

        $data = [
            'shop'     => $alert->getShop(),
            'message'  => $alertTypeDTO->getMessage(),
            'title'    => $alertTypeDTO->getTitle() ?? $alertTypeDTO->getDefaultTitle(),
            'alert'    => $alert,
            'oldDate'  => $deliveryDiffDates->getOldDeliveryDate() ? ' From ' . $deliveryDiffDates->getOldDeliveryDate()->format('m/d/Y') : '',
            'newDate'  => ' to ' . $deliveryDiffDates->getNewDeliveryDate()->format('m/d/Y'),
            'dateDiff' => $deliveryDiffDates->getDateDiffAsString(),
        ];

        return $this->twig->render('@BodyshopsApp/Export/emails/alert_mail.html.twig', $data);
    }
}