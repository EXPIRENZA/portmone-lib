<?php


namespace Expirenza\portmone\entities;


class Request extends RequestAbstract
{
    public $paymentTypes;
    public $autopayment;
    public $priorityPaymentTypes;
    public $payee;
    public $order;
    public $token;
    public $payer;
    public $style;

    /**
     * @return PaymentTypesRequest
     */
    public function getPaymentTypes()
    {
        return $this->paymentTypes;
    }

    /**
     * @param PaymentTypesRequest $paymentTypes
     */
    public function setPaymentTypes($paymentTypes)
    {
        $this->paymentTypes = $paymentTypes;
    }

    /**
     * @return AutopaymentRequest
     */
    public function getAutopayment()
    {
        return $this->autopayment;
    }

    /**
     * @param AutopaymentRequest $autopayment
     */
    public function setAutopayment($autopayment)
    {
        $this->autopayment = $autopayment;
    }

    /**
     * @return PriorityPaymentTypesRequest
     */
    public function getPriorityPaymentTypes()
    {
        return $this->priorityPaymentTypes;
    }

    /**
     * @param PriorityPaymentTypesRequest $priorityPaymentTypes
     */
    public function setPriorityPaymentTypes($priorityPaymentTypes)
    {
        $this->priorityPaymentTypes = $priorityPaymentTypes;
    }

    /**
     * @return PayeeRequest
     */
    public function getPayee()
    {
        return $this->payee;
    }

    /**
     * @param PayeeRequest $payee
     */
    public function setPayee($payee)
    {
        $this->payee = $payee;
    }

    /**
     * @return Order
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param Order $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
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
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * @return mixed
     */
    public function getPayer()
    {
        return $this->payer;
    }

    /**
     * @param mixed $payer
     */
    public function setPayer($payer)
    {
        $this->payer = $payer;
    }

    /**
     * @return mixed
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * @param mixed $style
     */
    public function setStyle($style)
    {
        $this->style = $style;
    }

    /**
     * Generate data for make request
     *
     * @return false|string
     */
    public function generateRequestData()
    {
        $json = [];
        foreach (get_object_vars($this) as $name => $class) {
            if (!empty($class)) {
                foreach ($class as $subName => $value) {
                    if (!is_null($value)) {

                        if (!is_object($value)) {
                            $json[$name][$subName] = $value;
                        } else {

                        }
                    }
                }
            }
        }

        return json_encode($json);
    }

}
