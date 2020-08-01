<?php

namespace app\controllers\admin;

use app\models\admin\Lang;

class LangController extends AdminController
{
  public function indexAction() {
    $langs = \R::findAll('lang');
    $this->setMeta('Languages');
    $this->set(compact('langs'));
  }

  public function editAction() {
    if (!empty($_POST)) {
      $id = $this->getRequestID(false);
      $lang = new Lang();
      $data = $_POST;
      $lang->load($data);
      
      if (!$lang->validate($data)) {
        $lang->getErrors();
        redirect();
      }

      if ($lang->update('lang', $id)) {
        $_SESSION['success'] = 'Changes saved!';
      }

      redirect();
    }

    $lang_id = $this->getRequestId();
    $page_lang = \R::load('lang', $lang_id);

    $this->setMeta('Edit language');
    $this->set(compact('page_lang'));
  }

  public function addAction() {
    if (!empty($_POST)) {
      $lang = new Lang();
      $data = $_POST;
      $lang->load($data);
      if (!$lang->validate($data)) {
        $lang->getErrors();
          $_SESSION['form_data'] = $data;
      } else {
        if ($id = $lang->save('lang', false)) {
          $_SESSION['success'] = 'Язык добавлен';
          } else {
            $_SESSION['error'] = 'Error';
          }
      }
      redirect();
    }

    $this->setMeta('Новый язык');
  }

  public function deleteAction() {
    $id = $this->getRequestID();
    $lang = \R::load('lang', $id);
    \R::trash($lang);
    $_SESSION['success'] = "Язык удален";
    redirect();
}
}
