<?php


class Test extends MY_Controller
{
    public function index() {
        echo '<pre>';
        $users = $this->mmongo->query('baryga.users', []);
        $tasks = $this->mmongo->query('baryga.tasks', []);
//        $history = $this->mmongo->query('baryga.billing_history', []);
//        $id = new \MongoDB\BSON\ObjectId($this->session->userdata("UserId"));
//        $task = $this->mmongo->remove('baryga.tasks', ['userId' => $id]);
//        print_r($users);
//        print_r($this->session->userdata());
//        print_r($users);
        print_r($tasks);
//        print_r($history);
    }

    public function regionAdd()
    {
        echo '<pre>';

        $id = new \MongoDB\BSON\ObjectId('603a858e0c7f3164b214dd52');

        $regions = require_once APPPATH . 'components/cities.php';

        foreach ($regions as $region_id => $arr_region_info) {
            $this->mmongo->addRow('baryga.regions', array(
                "region_name" => $arr_region_info['region_name'],
                "region_id" => $region_id
            ));
        }

    }

    public function showRegionsTable()
    {
        $api = $this->mmongo->query('baryga.regions', []);
        echo '<pre>';
        print_r($api);
    }

    public function tester()
    {
        $user_id = new \MongoDB\BSON\ObjectId('602a6d82cfcc8c5e2855a5e2');

//        $this->mmongo->remove('baryga.tasks', ['userId' => $user_id]);
        $api = $this->mmongo->query('baryga.tasks', []);
        echo '<pre>';
        print_r($api);exit;

    }
}
