<?php


interface PaymentServiceInterface
{
    /**
     * Каждый платёжный сервис должен реализовать данный интерфейс
     */

    /**
     * Метод для получения ссылки на оплату
     */
    public function concreteGetPayUrl();

    /**
     * Метод для получения ответа от сервиса платежной системы
     * @param $data_response - считанные данные ответа от сервиса
     */
    public function concreteGetResp($data_response);

    /**
     * Метод отправки пользователя на страницу оплаты в платёжную систему
     */
    public function concreteSendUserToPay();
}