<?php


class Yandex_payment implements PaymentServiceInterface
{

    public function concreteGetPayUrl()
    {
        // TODO: Implement concreteGetPayUrl() method.
    }

    public function concreteGetResp($data_response)
    {
        // TODO: Implement concreteGetResp() method.
    }

    public function concreteSendUserToPay()
    {
        echo 'Код отправки на форму оплаты';
    }
}