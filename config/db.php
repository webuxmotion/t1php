<?php

if (MODE === 'development') {
  return [
    'dsn' => 'mysql:host=mysql;dbname=t1php_db;charset=utf8',
    'user' => 't1phpuser',
    'pass' => 't1phppass'
  ];
} else {
  return [
    'dsn' => 'mysql:host=<host>;dbname=<dbname>;charset=utf8',
    'user' => '<user>',
    'pass' => '<pass>'
  ];
}


