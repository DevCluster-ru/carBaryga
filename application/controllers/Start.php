<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Start extends MY_Controller
{
    public function index()
    {
        $u = $this->IsAuth();
        if (!$u) {
            $this->load->view('noauth', ["User" => null]);
        } else {
            $this->load->view('template', ["User" => $u, "Tasks" => $this->mmongo->getMyTasks()]);
        }
    }
}
