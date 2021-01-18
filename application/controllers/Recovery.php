<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Recovery extends MY_Controller
{
    /**
     * Функция отправки сообщения с паролем на email
     * @var array $_POST [email]
     * @return json | false
     */
    public function sendRecoveredPass()
    {
        $email = $this->input->post()['email_recovery'];

        if (!$email) {
            $result_msg['error'] = 'Вы ввели не корректный email';
            echo json_encode($result_msg);
            return false;
        }

        $user = $this->mmongo->query('baryga.users', array("email" => $email));

        if (!$user) {
            $result_msg['error'] = 'Такой почты не существует в нашей базе';
            echo json_encode($result_msg);
            return false;
        } else {

            $this->load->library('phpmailer');

            $params = [
                'recovery_id' => $user[0]->login,
                'recovery_hash' => md5(uniqid($email)),
            ];

            $this->load->helper('url');

//            $link = base_url("recovery/finish?" . http_build_query($params));

            $anchor = anchor("recovery/finish?" . http_build_query($params), "восстановление пароля");

            $data_send = [
                'email'     => $email, // email получателя
                'subject'   => 'Восстановление пароля', // заголовок письма
//                'body'      => "Перейдите по ссылке для восстановления пароля: " . "<a href='$link'>$link</a>", // текст письма
                'body'      => "Перейдите по ссылке для восстановления пароля: " . $anchor, // текст письма
            ];

            /* Кастомный метод отправления письма */
            $send = $this->phpmailer->sender($data_send);

            /* Запишем в БД ссылку для верификации пользователя */

            if (!$send) {
                $result_msg['error'] = 'Сообщение не было отправлено ' . $this->phpmailer->ErrorInfo;
                echo json_encode($result_msg);
                return false;
            }

            $user = $this->mmongo->update('baryga.users', array("email" => $email), ['recovery_params' => http_build_query($params)]);

            $result_msg['message'] = 'Сообщение отправленно на указанную почту';
            echo json_encode($result_msg);
            return false;
        }
    }

    /**
     * @var array $_GET - string params in URL array('recovery_id' => 'login', 'recovery_hash' => 'ab9aae4dad51556006fded7a20d8e4cd')
     * Принимаем из ссылки параметры на восстановление, и проверяем на совпадение, для нужного пользователя в БД
     */
    public function finish()
    {
        $params = $this->input->get();

        // Конверт параметров в строку для проверки на аналогичность в БД

        $str_params = http_build_query($params);

        if (isset($params['recovery_id']) && isset($params['recovery_hash'])) {

            $login = $params['recovery_id'];
            $user  = $this->mmongo->query('baryga.users', array("login" => $login));

            if ($user) {
                $recovery_params = $user[0]->recovery_params;

                if ($recovery_params == $str_params) {
                    /**
                     * Если параметры в ссылке и параметры в БД схожи, то разрешаем переопределить пароль
                     */
                    $this->load->view('recovery_pass_finish.php');

                } else {
                    show_404();
                }
            }
        } else {
            show_404();
        }
    }

    public function editPassword()
    {
        /**
         * Метод - отправка изменённого пароля на сервер
         * @param array $_POST[recovery_id, password, confirm_password]
         * @returns void
         */

        $params = $this->input->post();
        $error  = $this->validateReg($this->input->post());

        if (!$error) {

            $login = $params['recovery_id'];
            $user = $this->mmongo->update('baryga.users', ['login' => $login], [
                'password' => $params['password'],
                'recovery_params' => ''
                ]);

            header('Location: /');
        } else {

            $this->session->set_flashdata('errors', array_shift($error));
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
}