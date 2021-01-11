<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Recovery extends MY_Controller
{
    public function sendRecoveredPass()
    {

        /**
         * Функция отправки сообщения с паролем на email
         * @param POST email
         */

        $result_msg = '';
        $email = $this->input->post()['email_recovery'];

        if (!$email) {
            $result_msg = 'Вы ввели не корректный email';
            echo $result_msg;
            return false;
        }

        $user = $this->mmongo->query('baryga.users', array("email" => $email));

        if (!$user) {
            $result_msg = 'Такой почты не существует в нашей базе';
            echo $result_msg;
            return false;
        } else {

            $this->load->library('phpmailer');

            $this->phpmailer->isSMTP();
            $this->phpmailer->Host = 'smtp.gmail.com';
            $this->phpmailer->SMTPAuth = true;
            $this->phpmailer->Username = 'tester.cars2021'; // Логин в google. Именно логин, без @gmail.com
            $this->phpmailer->Password = 'admintest123'; // Пароль
            $this->phpmailer->SMTPSecure = 'ssl';
            $this->phpmailer->Port = 465;
            $this->phpmailer->setFrom('tester.cars2021@gmail.com'); // Ваш Email

            $this->phpmailer->addAddress('bigrise1711@gmail.com'); // Email получателя
            //$this->phpmailer->addAddress('example@gmail . com'); // Еще один email, если нужно.// Прикрепление файлов

            // Письмо
            $this->phpmailer->CharSet = "utf-8";
            $this->phpmailer->isHTML(true);
            $this->phpmailer->Subject = 'Восстановление пароля'; // Заголовок письма

            $params = [
                'recovery_id' => $user[0]->login,
                'recovery_hash' => md5(uniqid($email)),
            ];

            $this->load->helper('url');

            $link = base_url("recovery/finish?" . http_build_query($params));

            $this->phpmailer->Body = "Перейдите по ссылке для восстановления пароля: " . $link; // Текст письма

            // Результат
            if (!$this->phpmailer->send()) {
                $result_msg = 'Сообщение не было отправлено ' . $this->phpmailer->ErrorInfo;
                echo $result_msg;
                return false;
            } else {
                /* Запишем в БД ссылку для верификации пользователя */

                $user = $this->mmongo->update('baryga.users', array("email" => $email), ['recovery_params' => http_build_query($params)]);

                $result_msg = 'Сообщение отправленно на указанную почту';
                echo $result_msg;
                return true;

                /**
                 * Напоминание:
                 * 1)Рефактор этот метод.
                 * 2)Создать контроллер Recovery и перенести туда этот метод
                 * И создать новый recovery/finish
                 * После перехода по ссылке будет переходить в этот метод
                 * там сравниваем пришедшие параметры и по юзеру логину находим пользователя
                 * если вся строка параметров совпадает, переходим на страницу восстановления пароля.
                 */
            }
        }
    }

    public function finish()
    {
        /**
         * @param $_GET - string params in URL array('recovery_id' => 'login', 'recovery_hash' => 'ab9aae4dad51556006fded7a20d8e4cd')
         * Принимаем параметры и проверяем на совпадение, для нужного пользователя в БД
         */

        $params = $this->input->get();

        // Конверт параметров в строку для проверки на аналогичность в БД
        $str_params = http_build_query($params);

        if (isset($params['recovery_id']) && isset($params['recovery_hash'])) {

            $login = $params['recovery_id'];
            $user = $this->mmongo->query('baryga.users', array("login" => $login));

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
        $params = $this->input->post();
        $error  = $this->validateReg($this->input->post());

        if (!$error) {

            $login = $params['recovery_id'];
            $user = $this->mmongo->update('baryga.users', ['login' => $login], ['password' => $params['password']]);

            header('Location: /');
        } else {

            $this->session->set_flashdata('errors', array_shift($error));
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
}