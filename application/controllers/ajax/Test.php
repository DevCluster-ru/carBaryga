<?php


class Test extends MY_Controller
{
    public function index() {
        $users = $this->mmongo->query('baryga.users', []);
        echo '<pre>';
        print_r($users);
    }
}