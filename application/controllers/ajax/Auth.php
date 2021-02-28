<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends MY_Controller
{

    public function index()
    {
        $result = $this->mmongo->tryAuth($this->input->post());

        if ($result && is_array($result)) {
            $this->session->set_userdata([
                "UserId" => $result[0]->_id,
                "UserEmail" => $result[0]->email,
                "UserName" => $result[0]->login,
                "UserTelegram" => $result[0]->telegram,
                "UserBalance" => $result[0]->balance,
                "EndSubscription" => $result[0]->end_subscription,
            ]);
            echo json_encode('true');
            return true;
        } else {
            return false;
        }
    }

    public function editProfile()
    {
        $params = $this->input->post();
        $error  = $this->validateReg($params);
        $user = false;

        if (!$error) {
            $this->mmongo->update('baryga.users', ['_id' => $this->session->userdata('UserId')], [
                'login' => $params['login'],
                'password' => $params['password'],
                'email' => $params['email'],
                'telegram' => $params['telegram'],
            ]);

            $this->session->set_userdata([
                "UserEmail" => $params['email'],
                "UserName" => $params['login'],
                "UserTelegram" => $params['telegram'],
            ]);

            return true;

        } else {
            echo json_encode($error);
            return false;
        }
    }

    public function getBalance()
    {
        $email = $this->session->userdata('UserEmail');
        $result = $this->mmongo->query('baryga.users', ['email' => $email]);
        echo json_encode($result[0]->balance);
    }

}
