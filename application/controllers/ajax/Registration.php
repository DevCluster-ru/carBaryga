<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Registration extends MY_Controller
{

    public function index()
    {
        /**
         * Валидация формы регистрации
         * $error == false || array('input' => 'value_error') ...
         */

        $error = $this->validateReg($this->input->post());

        if ($error) {
            echo json_encode($error);
            return false;
        }

        $result = $this->mmongo->tryRegistration($this->input->post());
        $post = $this->input->post();

        if ($result && is_array($result)){

            /* Отправляем письмо об успешной регистрации */

            $this->load->library('phpmailer');

            $data_send = [
                'email'     => $post['email'], // email получателя
                'subject'   => 'Регистрация на CARBOT', // заголовок письма
                'body'      => "<h3>Регистрация на CARBOT прошла успешно</h3><br>
                                Данные для входа:<br>
                                Email: " . $post['email'] . "<br>
                                Пароль: " . $post['password'] // текст письма
            ];

            $send = $this->phpmailer->sender($data_send);

            $this->session->set_userdata([
                "UserId" => $result[0]->_id,
                "UserEmail" => $result[0]->email,
                "UserName" => $result[0]->login,
                "UserTelegram" => $result[0]->telegram,
                "UserBalance" => 0,
            ]);
            $this->session->set_flashdata('registration', 'success');
        }
    }
}
