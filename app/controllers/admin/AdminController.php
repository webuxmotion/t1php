<?php

namespace app\controllers\admin;

use core\base\Controller;
use app\models\User;
use app\models\AppModel;
use core\App;

class AdminController extends Controller
{
    public $layout = 'admin';
    public $lang;

    public function __construct($route) {
        parent::__construct($route);

        if (!User::isAdmin()) {
            redirect(ADMIN . '/auth/login-admin');
        }

        new AppModel();

        App::$app->setProperty('langs', \Lang::getLangs());
        App::$app->setProperty('lang', \Lang::getLang(App::$app->getProperty('langs')));

        $this->lang = App::$app->getProperty('lang');
    }
}

