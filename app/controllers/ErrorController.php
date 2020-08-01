<?php

namespace app\controllers;

class ErrorController extends AppController
{
    public function page404Action() {
        
        $this->setMeta('Page not found.');
    }
}