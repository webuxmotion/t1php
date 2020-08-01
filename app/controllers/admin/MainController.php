<?php

namespace app\controllers\admin;

class MainController extends AdminController
{
    public function indexAction() {
        $countUsers = \R::count('user');

        $this->set(compact('countUsers'));
        $this->setMeta('Панель управления');
    }
}
