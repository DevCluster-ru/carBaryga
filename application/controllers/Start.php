<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Start extends MY_Controller
{
    public function index()
    {
        $this->load->library('user_agent');
        //$res = $this->mmongo->getLastActiveTask();

        /* Если мы пришли с Qiwi, перезагружаем страницу */
        if ($this->agent->is_referral())
        {
            if ($this->agent->referrer() == 'https://oplata.qiwi.com/') {

                $this->redirect('/start/redirect', 3);
                exit;
            }
        }

        $user_data = $this->IsAuth();
        
        /* Проверяем подписку пользователя на действительность */

        $check_sub = $this->checkSubscription();
        
        if (!$user_data) {
            $this->load->view('noauth', ["User" => null]);
        } else {

            $tasks = $this->mmongo->getMyTasks();

            /* Получаем количество активированных задач, для счетчика во вьюшке */

            $active_tasks = array_filter($tasks, function ($value) {
                if ($value->status == true) {
                    return true;
                }
                return false;
            });

            $count_active = count($active_tasks);
//echo $count_active;exit;
            if ($check_sub == false) {

                if ($count_active > 1) {
                    $this->mmongo->stopActiveTasks();
                    header('Refresh: 0');
                }
            }

            /* История оплат */

            $transactions = $this->mmongo->historyPaymentForUser();

            /* Список городов и регионов для создания задачи и марок автомобилей */
            $cities = $this->returnCities();
            $marks  = $this->returnMarksAndModels();

            $this->load->view('template', [
                "User" => $user_data,
                "Tasks" => $tasks,
                "count_active_tasks" => $count_active,
                "transactions" => $transactions,
                "cities" => $cities,
                "marks" => $marks,
            ]);
        }
    }

    /**
     * @param string $url - строка для переадресация
     * @param integer $delay - задержка перед переадресацией
     */
    public function redirect($url = null, $delay = null)
    {
        $page = $url != null ? $url : '/';
        $sec = $delay != null ? $delay : '0';

        header("Refresh: $sec; url=" . $page);
        exit;
    }

    /**
     * Получение регионов и городов во вьшку добавления новой задачи по машине
    */
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

    public function getMarksAndModels()
    {
        $marks = $this->returnMarksAndModels();

        $mark_name = $this->input->post('mark_name');

        if (isset($mark_name))
        {
            echo json_encode($marks[$mark_name]['models']); // возвращаем данные в JSON формате;
        }
        else
        {
            echo json_encode(array('Выберите модель'));
        }
        exit;
    }

    /**
     * Подключение файла со списком областей и городов
    */
    public function returnCities()
    {
//        return require_once APPPATH . 'components/cities.php';

        return $this->mmongo->getRegions();

    }
    public function returnCitiesAjax()
    {
        echo json_encode($this->mmongo->getRegions());
    }

    /**
     * @return array $marks - возврат всех марок машин и моделей (Avito)
     */
    public function returnMarksAndModels()
    {
        return require_once APPPATH . 'components/marks_and_models.php';
    }
}
