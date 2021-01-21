<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Start extends MY_Controller
{
    public function index()
    {
        $this->load->library('user_agent');
        if ($this->agent->is_referral())
        {
            if ($this->agent->referrer() == 'https://oplata.qiwi.com/') {

                sleep(3);
                $this->redirect('/start/redirect', 0);
                exit;
            }
        }

        $user_data = $this->IsAuth();
        if (!$user_data) {
            $this->load->view('noauth', ["User" => null]);
        } else {

            /* Проверяем баланс и если 0, то отключаем все активные подписки */

            if ($user_data['UserBalance'] <= 0) {
                $this->mmongo->stopActiveTasks();
            }

            $tasks = $this->mmongo->getMyTasks();

            /* Получаем количество активированных задач, для счетчика во вьюшке */

            $active_tasks = array_filter($tasks, function ($value) {
                if ($value->status == true) {
                    return true;
                }
                return false;
            });

            $count_active = count($active_tasks);

            /* История оплат */

            $transactions = $this->mmongo->historyPaymentForUser();

            /* Список городов и регионов для создания задачи */

            $cities = $this->returnCities();

            $this->load->view('template', [
                "User" => $user_data,
                "Tasks" => $tasks,
                "count_active_tasks" => $count_active,
                "transactions" => $transactions,
                "cities" => $cities,
            ]);
        }
    }

    public function redirect($url = null, $delay = null)
    {
        $page = $url != null ? $url : '/';
        $sec = $delay != null ? $delay : '0';

        header("Refresh: $sec; url=" . $page);
        exit;
    }

    public function getCities()
    {
        $cities = $this->returnCities();

        $region_id = $_GET['region_id'];

        if (isset($region_id))
        {
            echo json_encode($cities[$region_id]['cities']); // возвращаем данные в JSON формате;
        }
        else
        {
            echo json_encode(array('Выберите область'));
        }
        exit;
    }

    public function returnCities()
    {
        return require_once APPPATH . 'components/cities.php';
    }

}
