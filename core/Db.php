<?php

namespace core;

class Db
{
  use TSingletone;

  protected function __construct() {

    $db = require_once CONF . '/db.php';

    \R::setup($db['dsn'], $db['user'], $db['pass']);

    if (!\R::testConnection()) {
      throw new \Exception('Cannot connect to DB', 500);
    }

    \R::freeze(true);

    if (DEBUG) {
      \R::debug(true, 1);
    }

    \R::ext('xdispense', function($type){
      return \R::getRedBean()->dispense( $type );
    });

  }
}
