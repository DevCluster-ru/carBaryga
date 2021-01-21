<?php


class Qiwi_payment implements PaymentServiceInterface
{
    protected $codeigniter;

    public function __construct()
    {
        $this->codeigniter = &get_instance();
    }

    /**
     * Направляем пользователя на оплату в платёжной системе
     */
    public function concreteSendUserToPay()
    {
        /**
         * Получаем URL из метода и направляем пользователя на оплату
         */

        $pay_url = $this->concreteGetPayUrl();

        header('Location: ' . $pay_url);
    }

    /**
     * Получаем URL формы оплаты QIWI, для перенаправления пользователя
     * @return string url
     */
    public function concreteGetPayUrl()
    {
//        echo 'Настроить ключи и ответ  в этом методе и вуаля'; exit;

        $price = 1;
        $bill_id = uniqid();
        $user_id = $this->codeigniter->session->userdata('UserId');
        $user_email = $this->codeigniter->session->userdata('UserEmail');

//        $secret_key = 'eyJ2ZXJzaW9uIjoiUDJQIiwiZGF0YSI6eyJwYXlpbl9tZXJjaGFudF9zaXRlX3VpZCI6IndpaG9ibS0wMCIsInVzZXJfaWQiOiI3OTEwNTIwMDgwOCIsInNlY3JldCI6IjU3NGRiMTE2ZjNiMjA4ODlkZDRlYWY1MTI3YTYwOGZjYzljZGU2NjlhZjIzNzc0NTMzM2ViODE1MTk2YzZjOWQifX0=';
// Денис кей
        $secret_key = 'eyJ2ZXJzaW9uIjoiUDJQIiwiZGF0YSI6eyJwYXlpbl9tZXJjaGFudF9zaXRlX3VpZCI6InhieDdyOS0wMCIsInVzZXJfaWQiOiI3OTAyOTcxODgyNiIsInNlY3JldCI6IjdjZWQ1Y2Y4MTRjM2I2MWQ5NWZmMTc2YjI0YzQ3MGM5Y2E4MzVkZmM1OTgyMjFmNzcyNDcwMjFkZjk2MzFjMWEifX0=';
        $url = "https://api.qiwi.com/partner/bill/v1/bills/" . $bill_id;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "Content-Type: application/json",
            "Accept: application/json",
            "Authorization: Bearer " . $secret_key,
        );

        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $data = '{"amount": { "currency": "RUB", "value": ' . $price . ' }}';

        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        $resp = (array)json_decode($resp);

        if (curl_error($curl))
        {
            print curl_error($curl);
        }
        else
        {
            if (isset($resp['payUrl'])) {

                // paymentsWebhooks/responseQiwi - callback URL

                curl_close($curl);

                $this->codeigniter->load->helper('url');

                /* Раскомментировать после переноса сайта на домен */

//                $success_url = $this->codeigniter->uri->config->base_url();
                $success_url = 'http://94.73.238.150/';

                $resp['payUrl'] = $resp['payUrl'] . "&successUrl=" . $success_url;

                $this->codeigniter->mmongo->update('baryga.users', ['_id' => $user_id], [
                    'billId' => $bill_id
                ]);

                $this->codeigniter->mmongo->addRow('baryga.billing_history', [
                    'user_id' => $user_id,
                    'email' => $user_email,
                    'billId' => $bill_id,
                    'payment_service' => 'QIWI',
                    'status' => 'WAIT',
                    'date' => date('Y-m-d H:i:s')
                ]);

                return $resp['payUrl'];
            }
        }
    }

    /**
     * Получение ответа от сервиса QIWI и изменяем данные по пользователю в БД
     * @param json $data_response - ответ от QIWI : example { "bill" : { "status" : { "value" : "PAID" }, "billId" : "600469100d583" } }
     */
    public function concreteGetResp($data_response)
    {
        try {
            $data_response = (array)json_decode($data_response, true);

            $status_payment = $data_response['bill']['status']['value'];
            $bill_id = $data_response['bill']['billId'];

            if ($status_payment == 'PAID') {

                /* Если платёж успешен меняем данные в БД */

                $user = $this->codeigniter->mmongo->query('baryga.users', ['billId' => $bill_id]);

                if ($user) {

                    $this->codeigniter->mmongo->update('baryga.users', ['billId' => $bill_id], [
                        'balance' => 299,
                    ]);

                    $this->codeigniter->mmongo->update('baryga.billing_history', ['billId' => $bill_id], [
                    'status' => 'PAID'
                ]);

                } else {
                    throw new Exception('Unknown billing id');
                }

            } else {
                throw new Exception('Payment is not successful');
            }
        } catch (Exception $e) {
            show_error($e->getMessage());
            log_message('error', $e->getMessage());
        }
    }
}