<?php


namespace Expirenza\portmone\entities;


class RequestForStatus extends Request
{
    protected $payeeId;
    protected $login;
    protected $password;
    protected $shopOrderNumber;

    public function __construct($payeeId, $login, $password, $shopOrderNumber)
    {
        $this->payeeId = $payeeId;
        $this->login = $login;
        $this->password = $password;
        $this->shopOrderNumber = $shopOrderNumber;


    }

    public function generateRequestData()
    {
        $startDate = new \DateTime();
        $endDate = clone($startDate);

        $startDate->modify('-12 days');
        $endDate->modify('+12 days');

        return [
            'method' => 'result',
            'payee_id' => $this->payeeId,
            'login' => $this->login,
            'password' => $this->password,
            'shop_order_number' => $this->shopOrderNumber,
            'status' => 'PAYED',
            'start_date' => $startDate->format('d.m.Y'),
            'end_date' => $endDate->format('d.m.Y'),
        ];
    }

}
