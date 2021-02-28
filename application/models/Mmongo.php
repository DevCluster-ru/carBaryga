<?php

class Mmongo extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }


    private function manager()
    {
        return new MongoDB\Driver\Manager("mongodb://localhost:27017");
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
            "date_registration" => date('d-m-Y H:i:s'),
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
        $mark_auto      = !isset($params['mark_auto']) || $params['mark_auto'] == 'Выберите модель'     ? NULL : $params['mark_auto'];
        $model_auto     = !isset($params['model_auto']) || $params['model_auto'] == 'Выберите марку'    ? NULL : $params['model_auto'];
        $keyWords       = $mark_auto . ' ' . $model_auto;

        /* Проверяем подписку и устанавливаем время давности объявления */
        
        $codeigniter = &get_instance();
        $check_sub = $codeigniter->checkSubscription();

        if ($check_sub) {
            $pubTime = 1;
        } else {
            $pubTime = 180;
        }

        $this->addRow('baryga.tasks', array(
            "userId" => $this->session->userdata("UserId"),
            "keyWords" => $keyWords,
            "mark_auto" => $mark_auto,
            "model_auto" => $model_auto,
            "year_from" => $params["year_from"],
            "year_to" => $params["year_to"],
            "priceFrom" => $params["priceFrom"],
            "priceTo" => $params["priceTo"],
            "pubTime" => $pubTime,
            "status" => false,
            "region_id" => $region_id,
            "region_name" => $region_name,
            "created_at" => date('Y-m-d H:i:s', time()),
            "updated_at" => NULL,
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
    public function getActiveTasks()
    {
        return $active_tasks = $this->query("baryga.tasks",
            ["userId" => $this->session->userdata("UserId"), 'status' => true]
        );
    }
    public function getLastActiveTask()
    {
        $id = new \MongoDB\BSON\ObjectId($this->session->userdata("UserId"));
        $filter = ['userId' => $id, 'status' => true];
        $options = ['sort' => array('_id' => -1), 'limit' => 1];

        $query = new MongoDB\Driver\Query($filter, $options);
        $cursor = $this->manager()->executeQuery('baryga.tasks', $query);

        return $last_task = $cursor->toArray();
    }

    public function statusChange($post)
    {
        $id = new \MongoDB\BSON\ObjectId($post["task_id"]);
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

    /**
     * @param $post array ['id', 'mark_auto', 'model_auto', 'priceTo', year_to .... ]
     */
    public function editTask($post)
    {
        parse_str($post['data'], $params);

        $mark_auto      = !isset($params['mark_auto']) || $params['mark_auto'] == 'Выберите модель'     ? NULL : $params['mark_auto'];
        $model_auto     = !isset($params['model_auto']) || $params['model_auto'] == 'Выберите марку'    ? NULL : $params['model_auto'];
        $keyWords       = $mark_auto . ' ' . $model_auto;

        if (!isset($params['all_regions']) || $params['all_regions'] == false) {
            $region_id      = !isset($params['region_id']) || $params['region_id'] == 'Выберите область'    ? NULL : $params['region_id'];
            $region_name    = $post['region_name'] == 'Выберите область' || empty($post['region_name'])     ? NULL : $post['region_name'];
        } else {
            $region_id      = '';
            $region_name    = '';
        }

        /* Проверяем подписку и устанавливаем время давности объявления */

        $codeigniter = &get_instance();
        $check_sub = $codeigniter->checkSubscription();

        if ($check_sub) {
            $pubTime = 1;
        } else {
            $pubTime = 180;
        }

        $id = new \MongoDB\BSON\ObjectId($params["id"]);
        return $this->update("baryga.tasks", ['_id' => $id],
            [
                "keyWords" => $keyWords,
                "mark_auto" => $mark_auto,
                "model_auto" => $model_auto,
                "year_from" => $params["year_from"],
                "year_to" => $params["year_to"],
                "priceFrom" => $params["priceFrom"],
                "priceTo" => $params["priceTo"],
                "pubTime" => $pubTime,
                "region_id" => $region_id,
                "region_name" => $region_name,
                "updated_at" => date('Y-m-d H:i:s', time())
            ]
        );
    }

    /**
     * Метод для вывода истории платежей для юзера
    */
    public function historyPaymentForUser()
    {
//        $id = new \MongoDB\BSON\ObjectId($this->session->userdata("UserId"));
        return $this->mmongo->query('baryga.billing_history', ['user_id' => $this->session->userdata('UserId')]);
    }

    /**
     * Метод изменения баланса после окончания подписки
     * @param integer $value_balance - значение баланса, которое необходимо установить
    */
    public function setBalanceUser($value_balance)
    {
        $id = new \MongoDB\BSON\ObjectId($this->session->userdata("UserId"));

        $this->mmongo->update('baryga.users', ['_id' => $id], [
            'balance' => $value_balance,
        ]);
    }

    public function getRegions()
    {
        return $this->mmongo->query('baryga.regions', []);
    }
}