<?php


namespace Expirenza\portmone;


use Expirenza\portmone\entities\Auth;
use Expirenza\portmone\entities\Client;
use Expirenza\portmone\entities\Order;

interface PortmoneInterface
{
    public function __construct(Auth $auth, $returnUrl);

    public function getOrderStatus(Order $order);

    public function paymentPage(Client $client);

    public function paymentToCardPage(Client $client);

    public function cardTokenPage();

    public function parseResponseReturn(string $responseString);
    public function parseResponseOrderStatus(string $responseString);

}
