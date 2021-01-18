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

    function update($collection, $filter, $row)
    {
        $bulk = new MongoDB\Driver\BulkWrite;
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
            "telegram" => str_replace("@", "", $post["telegram"])
        ));

        return $this->tryAuth(array("email" => $post["email"], "password" => $post["password"]));
    }

    public function validate($post)
    {

        /* Метод валидации полей регистрации и авторизации */

        $error = false;
        $telegram = str_replace("@", "", $post["telegram"]);

        if (isset($post['login']) && strlen($post['login']) < 4) {
            $error['login'] = 'Минимальная длина логина 4 символа';
        }

        if (isset($post['password'])) {

            switch ($post['password']) {
                case strlen($post['password']) < 6:
                    $error['password'][] = 'Минимальная длина пароля 6 символов';
                case $post['password'] != $post['confirm_password']:
                    $error['password'][] = 'Подтверждение пароля не совпадает';
                case preg_match("/.*[0-9].*/", $post['password']) == false:
                    $error['password'][] = 'Пароль должен содержать хотя бы одну цифру';
            }
        }

        if (isset($post['email'])) {

            if (strpos($post['email'], '@') == false && strlen($post['email']) < 3) {
                $error['email'] = 'Не корректный Email';
            }
        }

        if (isset($post["telegram"]) && empty($telegram)) {
            $error['telegram'] = 'Не корректный telegram name';
        }
        return $error;
    }

    public function addTask($post)
    {
        $this->addRow('baryga.tasks', array(
            "userId" => $this->session->userdata("UserId"),
            "keyWords" => $post["keyWords"],
            "priceFrom" => $post["priceFrom"],
            "priceTo" => $post["priceTo"],
            "pubTime" => $post["pubTime"],
            "status" => false
        ));
    }

    public function getMyTasks()
    {
        $id = new \MongoDB\BSON\ObjectId($this->session->userdata("UserId"));
        return $this->query("baryga.tasks", ["userId" => $id]);
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
}