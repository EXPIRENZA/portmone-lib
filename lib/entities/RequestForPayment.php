<?php


namespace Expirenza\portmone\entities;


class RequestForPayment extends Request
{

    public function __construct($payeeId, $returnUrl, Order $order, Card $card = null, $login = null)
    {
        $this->paymentTypes = new PaymentTypesRequest();
        $this->paymentTypes->card = 'Y';
        $this->paymentTypes->gpayontoken = 'Y';
        $this->paymentTypes->applepayontoken = 'Y';

        $this->priorityPaymentTypes = new PriorityPaymentTypesRequest();
        $this->priorityPaymentTypes->card = "1";
        $this->priorityPaymentTypes->gpayontoken = "5";
        $this->priorityPaymentTypes->applepayontoken = "6";

        $this->payee = new PayeeRequest();
        $this->payee->payeeId = $payeeId;
        $this->payee->login = $login;
        $this->payee->dt = "";
        $this->payee->signature = "";
        $this->payee->shopSiteId = "";

        $this->order = new OrderRequest();
        $this->order->description = $order->getDescription();
        $this->order->billAmount = (string)$order->getSum();
        $this->order->shopOrderNumber = $order->getNumber();
        $this->order->attribute1 = "1";
        $this->order->attribute2 = "2";
        $this->order->attribute3 = "3";
        $this->order->attribute4 = "4";
        $this->order->encoding = "";

        $this->order->successUrl = $returnUrl;
        $this->order->failureUrl = $returnUrl;

        $this->order->preauthFlag = "N";
        $this->order->billCurrency = $order->getCurrency();
        $this->order->encoding = "";

        $this->token = new TokenRequest();
        $this->token->tokenFlag = "N";
        $this->token->returnToken = "N";
        $this->token->otherPaymentMethods = "N";

        $this->token->sellerToken = $card->getToken();

        $this->payer = new PayerRequest();
        $this->payer->lang = $order->getLang();
        $this->payer->showMail = "N";
    }

}
