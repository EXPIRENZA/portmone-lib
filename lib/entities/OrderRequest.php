<?php


namespace Expirenza\portmone\entities;


class OrderRequest
{
    public $description;
    public $shopOrderNumber;
    public $billAmount;
    public $attribute1;
    public $attribute2;
    public $attribute3;
    public $attribute4;
    public $successUrl;
    public $failureUrl;
    public $preauthFlag;
    public $preauthConfirm;
    public $billCurrency;
    public $expTime;
    public $encoding;
}
