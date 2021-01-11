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

        if ($result && is_array($result)){
            $this->session->set_userdata([
                "UserId"=>$result[0]->_id,
                "UserEmail"=>$result[0]->email
            ]);
        }
    }
}
