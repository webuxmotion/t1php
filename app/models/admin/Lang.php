<?php

namespace app\models\admin;

use app\models\AppModel;

class Lang extends AppModel 
{
    public $attributes = [
        'name' => '',
        'code' => '',
    ];

    public $rules = [
        'required' => [
            ['name'],
            ['code'],
        ],
    ];

    public function checkUnique() {
        $lang = \R::findOne('lang', 'code = ?', [$this->attributes['code']]);
        if ($lang) {
            if ($lang->code == $this->attributes['code']) {
                $this->errors['unique'][] = 'Этот code уже занят';
            }
            return false;
        }
        return true;
    }
}
