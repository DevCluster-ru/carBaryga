<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UpdateTask extends MY_Controller
{

    public function index()
    {
        $result = $this->mmongo->statusChange($this->input->post());

        if (isset($result['msg'])) {
            echo json_encode($result['msg']);
            return false;
        }
    }
}
