<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AddTask extends MY_Controller
{

    public function index()
    {
        $result = $this->mmongo->addTask($this->input->post());
    }
}
