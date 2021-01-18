<?php


class BasePayment
{
    protected $strategy;

    public function __construct(PaymentInterface $strategy)
    {
        $this->strategy = $strategy;
    }

    public function sendPayLogic()
    {
        $this->strategy->concreteSendPay();
    }

    public function getRespLogic()
    {
        $this->strategy->concreteGetResp();
    }

    public function setPayment(PaymentInterface $strategy)
    {
        $this->strategy = $strategy;
    }
}