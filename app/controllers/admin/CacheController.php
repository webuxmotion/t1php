<?php


namespace app\controllers\admin;


use core\Cache;

class CacheController extends AdminController
{
    public function indexAction() {
        $this->setMeta('Clear cache');
    }

    public function deleteAction() {
        $key = isset($_GET['key']) ? $_GET['key'] : null;
        $cache = Cache::instance();
        switch($key) {
            default: 
            $cache->delete($key);
        }
        $_SESSION['success'] = "Кеш удален";
        redirect();
    }
}
