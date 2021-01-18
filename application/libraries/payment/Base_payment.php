<?php


class Base_payment
{
    /**
     * Базовый класс для работы с платежными сервисами. При передаче в конструктор имени
     * класса платежного сервиса, будет выполняться код именно для этого сервиса
    */
    protected $strategy;
    protected $codeigniter;

    public function __construct($payment)
    {
        $this->strategy     = $payment['payment'];
        $this->codeigniter  = &get_instance();

        $this->codeigniter->load->library("payment/$this->strategy");
    }

    public function test() {
        echo 'Работает';
    }

    /**
     * Метод создания платежа для выбранной платежной системы. Платёжная система задана в $this->strategy, конструктором или setPayment
    */
    public function makePayment()
    {
        $this->codeigniter->{$this->strategy}->concreteSendUserToPay();
    }

    /**
     * Метод принятия ответа от сервисов. Используется в роутинге, в контроллере PaymentsWebhooks
    */
    public function processingResponse($data_response)
    {
        $this->codeigniter->{$this->strategy}->concreteGetResp($data_response);
    }

    /**
     * Предусмотрим замену платежной системы на ходу
    */
    public function setPayment($payment)
    {
        $this->strategy = $payment['payment'];
        $this->codeigniter->load->library("payment/$this->strategy");
    }
}