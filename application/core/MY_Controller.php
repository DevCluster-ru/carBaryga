<?php

class MY_Controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function IsAuth()
    {
        if (!$this->session->userdata("UserId")) {
            return false;
        }

        $user = $this->mmongo->query('baryga.users', ['_id' => $this->session->userdata("UserId")]);
        $end_subscription = isset($user[0]->end_subscription) ? $user[0]->end_subscription : NULL;
        $this->session->set_userdata(["UserBalance" => $user[0]->balance]);
        $this->session->set_userdata(["EndSubscription" => $end_subscription]);

        return [
            "UserTelegram" => $this->session->userdata("UserTelegram"),
            "UserEmail" => $this->session->userdata("UserEmail"),
            "UserName" => $this->UserName(),
            "UserId" => $this->session->userdata("UserId"),
            "UserBalance" => $this->session->userdata("UserBalance"),
            "EndSubscription" => $this->session->userdata("EndSubscription"),
        ];
    }

    public function UserName()
    {
        if ($this->session->userdata("UserId")) {
            if ($this->session->userdata("UserName")) {
                return $this->session->userdata("UserName");
            }
            return $this->session->userdata("UserEmail");
        }
        return false;
    }

    public function validateReg($post) {

        /* Метод валидации полей при регистрации */

        $error    = false;

        /* Проверка на существование почты или телеграмма */

//        if (empty($this->session->userdata('UserId'))) {
            $error    = $this->isExistUser($post, $error);
//        }

        if (isset($post['telegram'])) {
            $telegram = str_replace("@","", $post["telegram"]);
        }

        if (isset($post['password'])) {

            switch ($post['password']) {
                case strlen($post['password']) < 6:
                    $error['пароль'][] = 'Минимальная длина пароля 6 символов';
                case $post['password'] != $post['confirm_password']:
                    $error['пароль'][] = 'Подтверждение пароля не совпадает';
                case preg_match("/.*[0-9].*/", $post['password']) == false:
                    $error['пароль'][] = 'Пароль должен содержать хотя бы одну цифру';
            }
        }

        if (isset($post['login']) && strlen($post['login']) < 4) {
            $error['логин'] = 'Минимальная длина логина 4 символа';
        }

        if (isset($post['email'])) {

            if (strpos($post['email'], '@') == false || strlen($post['email']) < 4) {
                $error['email'] = 'Не корректный Email';
            }
        }

        if (isset($post["telegram"])) {
            if (empty($telegram)) {
                $error['телеграм'] = 'Не корректный telegram name';
            }
        }
        return $error;
    }

    public function isExistUser($post, &$errors) {

        $errors = false;

        $email = $this->session->userdata('UserEmail');
        $telegram = $this->session->userdata('UserTelegram');

        if (isset($post['email'])) {
            $result = $this->mmongo->query('baryga.users', array("email" => $post['email']));

            if (count($result) && $result[0]->email != $email) {
                $errors['email'] = 'Такой email уже используется';
            }
        }

        if (isset($post['telegram'])) {
            $result = $this->mmongo->query('baryga.users', array("telegram" => str_replace("@","", $post["telegram"])));

            if (count($result) && $result[0]->telegram != $telegram) {
                $errors['телеграм'] = 'Такой telegram name уже используется';
            }
        }

        return $errors;
    }
    /**
     * Метод сравнения даты окончания подписки пользователя, с текущей датой
     */
    public function checkSubscription()
    {
        $end_subscription    = $this->session->userdata('EndSubscription');

        if (strtotime($end_subscription) - time() <= 0) {
            $this->mmongo->setBalanceUser(0);
            return false;
        }
        
        return true;
    }
}