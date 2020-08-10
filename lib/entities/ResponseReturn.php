<?php


namespace Expirenza\portmone\instances;


class ResponseReturn extends BaseResponse
{
    protected $shopBillId;
    protected $shopOrderNumber;
    protected $approvalCode;
    protected $billAmount;
    protected $token;
    protected $result;
    protected $cardMask;
    protected $attribute1;
    protected $attribute2;
    protected $attribute3;
    protected $attribute4;
    protected $receiptUrl;
    protected $lang;
    protected $description;
    protected $ipsToken;
    protected $errorIpsCode;
    protected $errorIpsMessage;

    /**
     * @return mixed
     */
    public function getShopBillId()
    {
        return $this->shopBillId;
    }

    /**
     * @param mixed $shopBillId
     */
    public function setShopBillId($shopBillId): void
    {
        $this->shopBillId = $shopBillId;
    }

    /**
     * @return mixed
     */
    public function getShopOrderNumber()
    {
        return $this->shopOrderNumber;
    }

    /**
     * @param mixed $shopOrderNumber
     */
    public function setShopOrderNumber($shopOrderNumber): void
    {
        $this->shopOrderNumber = $shopOrderNumber;
    }

    /**
     * @return mixed
     */
    public function getApprovalCode()
    {
        return $this->approvalCode;
    }

    /**
     * @param mixed $approvalCode
     */
    public function setApprovalCode($approvalCode): void
    {
        $this->approvalCode = $approvalCode;
    }

    /**
     * @return mixed
     */
    public function getBillAmount()
    {
        return $this->billAmount;
    }

    /**
     * @param mixed $billAmount
     */
    public function setBillAmount($billAmount): void
    {
        $this->billAmount = $billAmount;
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param mixed $token
     */
    public function setToken($token): void
    {
        $this->token = $token;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @param mixed $result
     */
    public function setResult($result): void
    {
        $this->result = $result;
    }

    /**
     * @return mixed
     */
    public function getCardMask()
    {
        return $this->cardMask;
    }

    /**
     * @param mixed $cardMask
     */
    public function setCardMask($cardMask): void
    {
        $this->cardMask = $cardMask;
    }

    /**
     * @return mixed
     */
    public function getAttribute1()
    {
        return $this->attribute1;
    }

    /**
     * @param mixed $attribute1
     */
    public function setAttribute1($attribute1): void
    {
        $this->attribute1 = $attribute1;
    }

    /**
     * @return mixed
     */
    public function getAttribute2()
    {
        return $this->attribute2;
    }

    /**
     * @param mixed $attribute2
     */
    public function setAttribute2($attribute2): void
    {
        $this->attribute2 = $attribute2;
    }

    /**
     * @return mixed
     */
    public function getAttribute3()
    {
        return $this->attribute3;
    }

    /**
     * @param mixed $attribute3
     */
    public function setAttribute3($attribute3): void
    {
        $this->attribute3 = $attribute3;
    }

    /**
     * @return mixed
     */
    public function getAttribute4()
    {
        return $this->attribute4;
    }

    /**
     * @param mixed $attribute4
     */
    public function setAttribute4($attribute4): void
    {
        $this->attribute4 = $attribute4;
    }

    /**
     * @return mixed
     */
    public function getReceiptUrl()
    {
        return $this->receiptUrl;
    }

    /**
     * @param mixed $receiptUrl
     */
    public function setReceiptUrl($receiptUrl): void
    {
        $this->receiptUrl = $receiptUrl;
    }

    /**
     * @return mixed
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * @param mixed $lang
     */
    public function setLang($lang): void
    {
        $this->lang = $lang;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getIpsToken()
    {
        return $this->ipsToken;
    }

    /**
     * @param mixed $ipsToken
     */
    public function setIpsToken($ipsToken): void
    {
        $this->ipsToken = $ipsToken;
    }

    /**
     * @return mixed
     */
    public function getErrorIpsCode()
    {
        return $this->errorIpsCode;
    }

    /**
     * @param mixed $errorIpsCode
     */
    public function setErrorIpsCode($errorIpsCode): void
    {
        $this->errorIpsCode = $errorIpsCode;
    }

    /**
     * @return mixed
     */
    public function getErrorIpsMessage()
    {
        return $this->errorIpsMessage;
    }

    /**
     * @param mixed $errorIpsMessage
     */
    public function setErrorIpsMessage($errorIpsMessage): void
    {
        $this->errorIpsMessage = $errorIpsMessage;
    }


    public function isSuccess()
    {
        if ($this->result == '0' || $this->result == 0) {
            return true;
        }
        return false;
    }

    public function isFailed()
    {
        if ($this->result != '0' && $this->result != 0) {
            return true;
        }
        return false;
    }
}
