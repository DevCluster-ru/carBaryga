<?php


class Test extends MY_Controller
{
    public function index() {
//        $users = $this->mmongo->query('baryga.users', []);
        $tasks = $this->mmongo->query('baryga.tasks', []);
//        $history = $this->mmongo->query('baryga.billing_history', []);
//        $user = $this->mmongo->update('baryga.users', ['email' => 'hello@hello'], ['balance' => 299]);

        echo '<pre>';
        print_r($tasks);
//        print_r($users);
//        print_r($history);

    }
}