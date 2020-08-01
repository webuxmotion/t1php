<?php

require_once dirname(__DIR__) . '/config/init.php';
require_once LIBS . '/functions.php';
require_once CONF . '/routes.php';

class_alias('\RedBeanPHP\R', '\R');
class_alias('\app\widgets\lang\Lang', '\Lang');
class_alias('\core\Cache', '\Cache');

use core\App;

new App();
