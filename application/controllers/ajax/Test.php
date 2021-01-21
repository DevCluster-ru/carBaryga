<?php


class Test extends MY_Controller
{
    public function index() {
//        $users = $this->mmongo->query('baryga.users', []);
//        $tasks = $this->mmongo->remove('baryga.tasks', ['userId' => new \MongoDB\BSON\ObjectId('6005a4e6097c6840c2147112')]);
        $tasks = $this->mmongo->query('baryga.tasks', []);
//        $tasks = $this->mmongo->query('baryga.tasks', ['keyWords' => 'dasd']);
//        $history = $this->mmongo->remove('baryga.billing_history', ['billId' => '600469100d583']);
//        $history = $this->mmongo->query('baryga.billing_history', []);
//        $user = $this->mmongo->update('baryga.users', ['email' => 'hello@hello'], ['balance' => 0]);
//        $user = $this->mmongo->update('baryga.users', ['email' => 'webkrilya@gmail.com'], ['balance' => 0]);
//        $user = $this->mmongo->remove('baryga.billing_history', ['email' => 'hello@hello']);
//        $history_user = $this->mmongo->historyPaymentForUser();


        echo '<pre>';
        var_dump($tasks);
//        print_r($users);
//        print_r($history);
//        print_r($history_user);

    }
}