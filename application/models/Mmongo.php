<?php

class Mmongo extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }


    private function manager()
    {
        return new MongoDB\Driver\Manager("mongodb://192.168.0.100:27017");
    }

    public function query($collection, $q)
    {
        $query = new MongoDB\Driver\Query($q);
        $cursor = $this->manager()->executeQuery($collection, $query);
        return $cursor->toArray();
    }

    function addRow($collection, $row)
    {
        $bulk = new MongoDB\Driver\BulkWrite;
        $bulk->insert($row);
        $this->manager()->executeBulkWrite($collection, $bulk);
    }


    function agg($collection, $row)
    {
        $command = new MongoDB\Driver\Command([
            'aggregate' => $collection,
            'pipeline' => $row,
            'cursor' => new stdClass,
        ]);
        $cursor = $this->manager()->executeCommand('more', $command);
        return $cursor->toArray();

    }

    function update($collection, $filter, $row, $multi = null)
    {
        $bulk = new MongoDB\Driver\BulkWrite;
        if ($multi != null) {
            $bulk->update($filter, ['$set' => $row], $multi);
        }
        $bulk->update($filter, ['$set' => $row]);

        $this->manager()->executeBulkWrite($collection, $bulk);
    }

    function remove($collection, $filter)
    {
        $bulk = new MongoDB\Driver\BulkWrite;
        $bulk->delete($filter);
        $this->manager()->executeBulkWrite($collection, $bulk);
    }

/////////////////////////////////////////////////////////////////////////////////////////////////

    public function tryAuth($post)
    {
        $result = $this->query('baryga.users', array("email" => $post["email"], "password" => $post["password"]));
        return $result;
    }

    public function tryRegistration($post)
    {
        $this->addRow('baryga.users', array(
            "login" => $post["login"],
            "password" => $post["password"],
            "email" => $post["email"],
            "telegram" => str_replace("@", "", $post["telegram"]),
            "balance" => 0,
        ));

        return $this->tryAuth(array("email" => $post["email"], "password" => $post["password"]));
    }

    /**
     * @param array POST [data => string_params, region_name, city_name]
    */
    public function addTask($post)
    {
        parse_str($post['data'], $params);

        $region_id      = !isset($params['region_id']) || $params['region_id'] == 'Выберите область'    ? NULL : $params['region_id'];
        $region_name    = $post['region_name'] == 'Выберите область' || empty($post['region_name'])     ? NULL : $post['region_name'];
        $city_id        = !isset($params['city_id']) || $params['city_id'] == 'Выберите город'          ? NULL : $params['city_id'];
        $city_name      = $post['city_name'] == 'Выберите город' || empty($post['city_name'])           ? NULL : $post['city_name'];

        $this->addRow('baryga.tasks', array(
            "userId" => $this->session->userdata("UserId"),
            "keyWords" => $params["keyWords"],
            "priceFrom" => $params["priceFrom"],
            "priceTo" => $params["priceTo"],
            "pubTime" => $params["pubTime"],
            "status" => false,
            "region_id" => $region_id,
            "region_name" => $region_name,
            "city_id" => $city_id,
            "city_name" => $city_name,
        ));
    }

    public function getMyTasks()
    {
        $id = new \MongoDB\BSON\ObjectId($this->session->userdata("UserId"));
        return $this->query("baryga.tasks", ["userId" => $id]);
    }

    public function stopActiveTasks()
    {
        return $tasks = $this->update("baryga.tasks",
            ["userId" => $this->session->userdata("UserId"), 'status' => true],
            ['status' => false],
            ['multi' => true]
        );
    }

    public function statusChange($post)
    {
        $error = false;

        $user_tasks = $this->query("baryga.tasks", [
            "status" => true,
            "userId" => $this->session->userdata('UserId'),
        ]);
        $count_tasks = count($user_tasks);

        if ($count_tasks >= 10) {
            $error['msg'] = 'Лимит отслеживаемых заданий';
            return $error;
        }

        $id = new \MongoDB\BSON\ObjectId($post["id"]);
        $status = $this->query("baryga.tasks", ["_id" => $id]);

        if (!$status[0]->status) {
            $status = true;
        } else {
            $status = false;
        }

        return $this->update("baryga.tasks", ['_id' => $id], ["status" => $status]);
    }

    public function removeTask($taskId)
    {
        $id = new \MongoDB\BSON\ObjectId($taskId);
        $this->remove("baryga.tasks", ['_id' => $id]);

    }

    public function editTask($post)
    {
        $id = new \MongoDB\BSON\ObjectId($post["id"]);
        return $this->update("baryga.tasks", ['_id' => $id],

            [
                "keyWords" => $post["keyWords"],
                "priceFrom" => $post["priceFrom"],
                "priceTo" => $post["priceTo"],
                "pubTime" => $post["pubTime"]
            ]


        );
    }

    public function historyPaymentForUser()
    {
        return $this->mmongo->query('baryga.billing_history', ['user_id' => $this->session->userdata('UserId')]);
    }
}