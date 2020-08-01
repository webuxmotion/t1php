<?php

namespace app\controllers\admin;

use app\models\AppModel;
use app\models\User;
use core\base\Controller;
use core\libs\Pagination;

class AuthController extends Controller
{
    public $layout = 'admin';

    public function __construct($route)
    {
        parent::__construct($route);
    }

    public function loginAdminAction() {

        if (!empty($_POST)) {

            $user = new User();

            if (!$user->login(true)) {
                $_SESSION['error'] = 'Логин/пароль введены неверно';
            }

            if (User::isAdmin()) {
                redirect(ADMIN);
            } else {
                redirect();
            }
        }

        $this->layout = 'login';
        $this->setMeta('Панель управления');
    }
}
