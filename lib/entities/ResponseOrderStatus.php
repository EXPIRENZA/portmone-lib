<?php


namespace Expirenza\portmone\entities;


class ResponseOrderStatus extends BaseResponse
{
    protected $shopBillId;
    protected $shopOrderNumber;
    protected $description;
    protected $billDate;
    protected $payDate;
    protected $billAmount;
    protected $authCode;
    protected $status;
    protected $attribute1;
    protected $attribute2;
    protected $errorCode;

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
    public function getBillDate()
    {
        return $this->billDate;
    }

    /**
     * @param mixed $billDate
     */
    public function setBillDate($billDate): void
    {
        $this->billDate = $billDate;
    }

    /**
     * @return mixed
     */
    public function getPayDate()
    {
        return $this->payDate;
    }

    /**
     * @param mixed $payDate
     */
    public function setPayDate($payDate): void
    {
        $this->payDate = $payDate;
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
    public function getAuthCode()
    {
        return $this->authCode;
    }

    /**
     * @param mixed $authCode
     */
    public function setAuthCode($authCode): void
    {
        $this->authCode = $authCode;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
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
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * @param mixed $errorCode
     */
    public function setErrorCode($errorCode): void
    {
        $this->errorCode = $errorCode;
    }



    public function isSuccess()
    {
        if ($this->status == 'PAYED') {
            return true;
        }
        return false;
    }

    public function isFailed()
    {
        if ($this->status != 'PAYED') {
            return true;
        }
        return false;
    }
}
