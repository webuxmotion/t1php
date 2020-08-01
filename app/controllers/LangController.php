<?php

namespace app\controllers;


class LangController extends AppController
{
  public function changeAction(){

    $lang = !empty($_GET['lang']) ? $_GET['lang'] : null;

    if($lang){
        $lang_db = \R::findOne('lang', 'code = ?', [$lang]);

        if(!empty($lang_db)){
            setcookie('lang', $lang, time() + 3600*24*7, '/');
        }
    }
    redirect();
 }
}
