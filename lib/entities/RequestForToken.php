<?php


namespace Expirenza\portmone\entities;


class RequestForToken extends Request
{

    public function __construct($payeeId, $returnUrl)
    {
        $this->paymentTypes = new PaymentTypesRequest();
        $this->paymentTypes->createtokenonly = 'Y';

        $this->priorityPaymentTypes = new PriorityPaymentTypesRequest();
        $this->priorityPaymentTypes->createtokenonly = "1";

        $this->payee = new PayeeRequest();
        $this->payee->payeeId = $payeeId;

        $this->order = new OrderRequest();
        $this->order->successUrl = $returnUrl;
        $this->order->failureUrl = $returnUrl;

        $this->token = new TokenRequest();
        $this->token->tokenFlag = "N";
        $this->token->returnToken = "Y";
        $this->token->otherPaymentMethods = "N";
    }

}
