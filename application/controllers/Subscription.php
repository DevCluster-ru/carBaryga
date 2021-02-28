<?php


class Subscription extends CI_Controller
{
    public function index()
    {
        /* Тут может быть страница тарифов */

    }

    /**
     * Метод подготовки к оплате. Используется в форме на кнопке "Оплатить" - купить подписку
     * @var array $_POST ['payment_method'] - выбранный метод платежа, является именем класса
     * @return void
     * @throws Exception
     */
    public function preparationForPayment()
    {
        try {

            $pay_method = $this->input->post('payment_method');

            if (!empty($pay_method)) {

                $file = APPPATH . 'libraries/payment/' . ucfirst($pay_method) . '.php';

                if (file_exists($file)) {
                    $this->load->library(['payment/base_payment', 'base_payment'], ['payment' => $pay_method]);
                } else {
                    throw new Exception('Unknown payment');
                }

                $this->base_payment->makePayment();
            }

        } catch (Exception $exception) {
            echo $exception;
            show_error('Unable to load the requested class: ' . $pay_method);
        }
    }
}