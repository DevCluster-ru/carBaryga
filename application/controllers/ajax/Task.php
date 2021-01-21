<?php


class Task extends MY_Controller
{
    public function addTask()
    {
        $error = $this->validateTask($this->input->post());

        if ($error) {
            echo json_encode($error);
            return false;
        }

        $result = $this->mmongo->addTask($this->input->post());
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

        if (empty($params['keyWords'])) {
            $error['Ключевые слова'] = 'Не заполнены ключевые слова';
        }
        if (empty($params['priceFrom']) || empty($params['priceTo'])) {
            $error['Цена'][] = 'Цена не может быть пустой';
        }

        if ((int)$params['priceFrom'] > (int)$params['priceTo']) {
            $error['Цена'][] = 'Цена "ОТ" больше "ДО"';
        }

        return $error;
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
        $result = $this->mmongo->statusChange($this->input->post());

        if (isset($result['msg'])) {
            echo json_encode($result['msg']);
            return false;
        }
    }
}