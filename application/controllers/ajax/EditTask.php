<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EditTask extends MY_Controller
{

    public function index()
    {
        $result = $this->mmongo->editTask($this->input->post());
    }
}
