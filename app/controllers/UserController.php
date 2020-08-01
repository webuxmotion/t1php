<?php

namespace app\controllers;

use app\models\User;

class UserController extends AppController
{
    public function signupAction() {

        if (!empty($_POST)) {
            $user = new User();
            $data = $_POST;
            $user->load($data);
            if (!$user->validate($data) || !$user->checkUnique()) {
                $user->getErrors();
                $_SESSION['form_data'] = $data;
            } else {
                $user->attributes['password'] = password_hash($user->attributes['password'], PASSWORD_DEFAULT);
                if ($user->save('user')) {
                    $_SESSION['success'] = 'Пользователь зарегистрирован';
                } else {
                    $_SESSION['error'] = 'Error';
                }
            }
            redirect();
        }

        $dataFromSession =  self::getFormValuesFromSession(['login', 'name', 'email', 'address']);

        extract($dataFromSession);

        $this->set(compact(array_keys($dataFromSession)));
        $this->setMeta('Registration');
    }

    public function loginAction() {
        if (!empty($_POST)) {
            $user = new User();
            if ($user->login()) {
                $_SESSION['success'] = 'Вы успешно авторизованы';
                redirect('/user/cabinet');
            } else {
                $_SESSION['error'] = 'Логин или пароль введены неверно';
            }
            redirect();
        }
        $this->setMeta('Login');
    }

    public function logoutAction() {
        if (isset($_SESSION['user'])) unset($_SESSION['user']);
        redirect();
    }

    private function getFormValuesFromSession($fields) {

        $res_data = [];

        foreach ($fields as $field) {
            $form_{$field} = isset($_SESSION['form_data'][$field]) ? $_SESSION['form_data'][$field] : '';
            $res_data["form_{$field}"] = $form_{$field};
        }
        
        return $res_data;
    }

    public function cabinetAction() {
        if (!User::checkAuth()) redirect();
        $this->setMeta('Profile');
    }

    public function editAction(){
        if(!User::checkAuth()) redirect('/user/login');
        if(!empty($_POST)){
            $user = new \app\models\admin\User();
            $data = $_POST;
            $data['id'] = $_SESSION['user']['id'];
            $data['role'] = $_SESSION['user']['role'];
            $user->load($data);
            if(!$user->attributes['password']){
                unset($user->attributes['password']);
            }else{
                $user->attributes['password'] = password_hash($user->attributes['password'], PASSWORD_DEFAULT);
            }
            if(!$user->validate($data) || !$user->checkUnique()){
                $user->getErrors();
                redirect();
            }
            if($user->update('user', $_SESSION['user']['id'])){
                foreach($user->attributes as $k => $v){
                    if($k != 'password') $_SESSION['user'][$k] = $v;
                }
                $_SESSION['success'] = 'Изменения сохранены';
            }
            redirect();
        }
        $this->setMeta('Изменение личных данных');
    }

    public function ordersAction(){
        if(!User::checkAuth()) redirect('/user/login');
        $user_id = $_SESSION['user']['id'];
        $orders = \R::getAll("
            SELECT `order`.*,
            ROUND(SUM(`order_product`.`price` * `order_product`.`qty`), 2) AS `sum`
            FROM `order`
            JOIN `order_product` ON `order`.`id` = `order_product`.`order_id`
            WHERE `user_id` = {$user_id}
            GROUP BY `order`.`id` ORDER BY `order`.`status`, `order`.`id`
        ");
        $this->setMeta('История заказов');
        $this->set(compact('orders'));
    }
}