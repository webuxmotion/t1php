<?php

namespace app\controllers\admin;

use app\models\AppModel;
use app\models\User;
use core\libs\Pagination;

class UserController extends AdminController
{
    public $layout = 'admin';

    public function __construct($route)
    {
        parent::__construct($route);

        new AppModel();
    }

    public function indexAction() {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 3;
        $count = \R::count('user');
        $pagination = new Pagination($page, $perpage, $count);
        $start = $pagination->getStart();
        $users = \R::findAll('user', "LIMIT $start, $perpage");

        $this->setMeta('Users list');
        $this->set(compact('users', 'pagination', 'count'));
    }

    public function addAction() {
        $this->setMeta('New user');
    }

    public function editAction() {
        if (!empty($_POST)) {
            $id = $this->getRequestID(false);
            $user = new \app\models\admin\User();
            $data = $_POST;
            $user->load($data);
            if (!$user->attributes['password']) {
                unset($user->attributes['password']);
            } else {
                $user->attributes['password'] = password_hash($user->attributes['password'], PASSWORD_DEFAULT);
            }
            if (!$user->validate($data) || !$user->checkUnique()) {
                $user->getErrors();
                redirect();
            }

            if ($user->update('user', $id)) {
                $_SESSION['success'] = 'Changes saved!';
                $_SESSION['user'] = \R::load('user', $id);
            }

            redirect();
        }

        $user_id = $this->getRequestId();
        $user = \R::load('user', $user_id);

        $this->setMeta('Edit user');
        $this->set(compact('user')); 
    }
}
