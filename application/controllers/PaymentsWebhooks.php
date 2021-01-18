<?php


class PaymentsWebhooks extends CI_Controller
{
    /**
     * Общий контроллер для принятия ответов от платёжных сервисов и направляем их по своим классам на обработку
     */

    /**
     * Метод для принятия данных отета от qiwi и направляем в класс Qiwi_payment
    */
    public function responseQiwi()
    {
        /* Читаем пришедшие данные и отправляем их на обработку в класс платёжного сервиса */

        $data_response = file_get_contents('php://input');

        // Тестовые данные
//        $data_response = '{ "bill" : { "status" : { "value" : "PAID" }, "billId" : "600469100d583" } }';

        /* Конструктор принимает параметр с названием класса и запускает его метод обработки */

        $this->load->library('payment/base_payment', ['payment' => 'qiwi_payment']);
        $this->base_payment->processingResponse($data_response);
    }
}