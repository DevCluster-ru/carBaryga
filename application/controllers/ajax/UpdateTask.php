<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UpdateTask extends MY_Controller
{

    public function index()
    {
        $result = $this->mmongo->statusChange($this->input->post());
    }
}
