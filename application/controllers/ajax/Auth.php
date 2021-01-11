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
                "UserTelegram" => $result[0]->telegram
            ]);
            echo json_encode('true');
            return true;
        } else {
            return false;
        }
    }
}
