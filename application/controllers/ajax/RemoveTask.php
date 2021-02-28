<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RemoveTask extends MY_Controller
{

    public function index()
    {
        $result = $this->mmongo->removeTask($this->input->post('id'));


    }
}
