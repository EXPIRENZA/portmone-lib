<?php


namespace Expirenza\portmone\entities;


class Auth
{
    protected $payeeId;
    protected $login;
    protected $password;

    public function __construct($payeeId, $login, $password)
    {
        $this->payeeId      = $payeeId;
        $this->login        = $login;
        $this->password     = $password;
    }

    /**
     * @return mixed
     */
    public function getPayeeId()
    {
        return $this->payeeId;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }
}
