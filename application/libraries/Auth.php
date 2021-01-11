<?php

class Auth
{

    public function __construct()
    {
        //parent::__construct();
        $this->load->library('session');
    }

    function IsAuth()
    {
        return "Yo";
        //return $this->session();
    }


}