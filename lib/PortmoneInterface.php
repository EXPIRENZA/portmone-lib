<?php


namespace Expirenza\portmone;


use Expirenza\portmone\instances\Actor;
use Expirenza\portmone\instances\Auth;
use Expirenza\portmone\instances\Card;
use Expirenza\portmone\instances\Client;
use Expirenza\portmone\instances\Order;
use Expirenza\portmone\instances\Seller;

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
