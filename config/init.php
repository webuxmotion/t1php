<?php

define("DEBUG", 1);
define("MODE", 'development');
define("DEFAULT_LANG", 'ru');
define("ROOT",   dirname(__DIR__));
define("WWW",    ROOT . '/public');
define("APP",    ROOT . '/app');
define("CORE",   ROOT . '/core');
define("LIBS",   ROOT . '/core/libs');
define("CACHE",  ROOT . '/tmp/cache');
define("TMP",  ROOT . '/tmp');
define("CONF",   ROOT . '/config');

require_once LIBS . '/functions.php';
define("PATH", getAppPath());

define("ADMIN", PATH . '/admin');

define("LAYOUT", 'default');

require_once ROOT . '/vendor/autoload.php';
