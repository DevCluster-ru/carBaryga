<?php

class Task extends MY_Controller
{
    public function addTask()
    {
        $error = $this->validateTask($this->input->post());

        /* Проверяем подписку, если нет подписки и уже есть задача, не разрешаем добавить задачу */
        $check_sub = $this->checkSubscription();

        if (!$check_sub) {
            $added_tasks = $this->mmongo->getMyTasks();
            $count_tasks = count($added_tasks);

            if ($count_tasks >= 1) {
                $error['Задание'][] = 'У вас уже используется бесплатное задание, чтобы создать больше заданий необходимо приобрести подписку';
            }
        }

        if ($error) {
            echo json_encode($error);
            return false;
        }

        $result = $this->mmongo->addTask($this->input->post());
    }

    public function editTask()
    {
        $result = $this->mmongo->editTask($this->input->post());
    }

    public function removeTask()
    {
        $result = $this->mmongo->removeTask($this->input->post('id'));
    }

    public function updateStatusTask()
    {
//        if ($this->checkSubscription()) {

            $result = $this->mmongo->statusChange($this->input->post());
//        } else {
//            $active_tasks = $this->mmongo->getActiveTasks();
//            $count_active = count($active_tasks);
//
//            if ($count_active >= 1) {
//                return false;
//            } else {
//                $result = $this->mmongo->statusChange($this->input->post());
//            }
//        }
    }

    /**
     * Метод валидации при создании задачи
     * @param array POST [
     * 'data' => string "userId, keyWords, priceFrom, priceTo, pubTime, status, region_id, city_id",
     * 'region_name', 'city_name'
     * @return array $error | false
     * ]
     */

    public function validateTask($post)
    {
        $error = false;

        parse_str($post['data'], $params);

        if (empty($params['mark_auto'])) {
            $error['Ключевые слова'] = 'Не заполнены ключевые слова';
        }
        if (empty($params['priceFrom']) || empty($params['priceTo'])) {
            $error['Цена'][] = 'Цена не может быть пустой';
        }

        if ((int)$params['priceFrom'] > (int)$params['priceTo']) {
            $error['Цена'][] = 'Цена "ОТ" больше "ДО"';
        }

        if ((int)$params['priceFrom'] > 20000000 || (int)$params['priceTo'] > 20000000) {
            $error['Цена'][] = 'Цена не может превышать 20 млн.';
        }

        if ((int)$params['year_from'] > (int)$params['year_to']) {
            $error['Год'][] = 'Год "ОТ" больше чем год "ДО"';
        }

        if (!isset($params['all_regions']) && !isset($params['some_regions'])) {
            if (empty($post['region_name']) || $post['region_name'] == ' ') {
                $error['Регион'][] = 'Вы должны выбрать регион';
            }
        }

        return $error;
    }
}