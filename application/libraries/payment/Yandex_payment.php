<?php


class Yandex_payment implements PaymentServiceInterface
{

    public function concreteGetPayUrl()
    {
        // TODO: Implement concreteGetPayUrl() method.
        header('Location: /');exit;
    }

    public function concreteGetResp($data_response)
    {
        // TODO: Implement concreteGetResp() method.
        header('Location: /');exit;
    }

    public function concreteSendUserToPay()
    {
        header('Location: /');exit;
    }
}