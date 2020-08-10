<?php


namespace Expirenza\portmone\entities;


class Client
{
    protected $order;
    protected $card;

    public function __construct(Order $order, Card $card)
    {
        $this->order = $order;
        $this->card = $card;
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param mixed $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }

    /**
     * @return mixed
     */
    public function getCard()
    {
        return $this->card;
    }

    /**
     * @param mixed $card
     */
    public function setCard($card): void
    {
        $this->card = $card;
    }



}
