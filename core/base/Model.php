<?php

namespace core\base;

use core\Db;
use Valitron\Validator;

abstract class Model
{
  public $attributes = []; 
  public $rules = [];
  public $error = [];

  public function __construct() {
    Db::instance();    
  }

  public function load($data) {
    foreach ($this->attributes as $name => $value) {
      if (isset($data[$name])) {
        $this->attributes[$name] = $data[$name];
      }
    }
  }

  public function save($table, $valid = true, $type = "redbean", $trancated_columns = []) {
     if ($type == "redbean") {
      if($valid){
          $tbl = \R::dispense($table);
      }else{
          $tbl = \R::xdispense($table);
      }
      foreach($this->attributes as $name => $value){
          $tbl->$name = $value;
      }
      return \R::store($tbl);
     }
     else if ($type == "default") {

       $values = [];
       $sql_part_columns = '';
       $sql_part_values_palceholders = '';
       foreach($this->attributes as $name => $value) {
         if (!in_array($name, $trancated_columns)) {
          array_push($values, $value);
          $sql_part_columns .= $name . ',';
          $sql_part_values_palceholders .= '?,';
         }
       }
       $sql_part_columns = rtrim($sql_part_columns, ',');
       $sql_part_values_palceholders = rtrim($sql_part_values_palceholders, ',');

       \R::exec("
         INSERT INTO $table ($sql_part_columns) VALUES ($sql_part_values_palceholders)"
        , $values);

       $id = \R::getInsertID();

       foreach($trancated_columns as $column) {
         $value = $this->attributes[$column];
         \R::exec("UPDATE `$table` SET `$column` = '$value' WHERE `$table`.`id` = $id;");
       }

       return $id;
     }
  }

    public function update($table, $id, $type = "redbean", $trancated_columns = []) {
      if ($type == "redbean") {
        $bean = \R::load($table, $id);
        foreach($this->attributes as $name => $value){
            $bean->$name = $value;
        }
        return \R::store($bean);
      }
      else if ($type == "default") {

        $values = [];
        $sql_part = '';
        foreach($this->attributes as $name => $value) {
          if (!in_array($name, $trancated_columns)) {
            array_push($values, $value);
            $sql_part .= $name . '=?' . ',';
          }
        }
        array_push($values, $id);
        $sql_part = rtrim($sql_part, ',');

        \R::exec("
          UPDATE $table SET $sql_part WHERE id=?"
        , $values);

        foreach($trancated_columns as $column) {
          $value = $this->attributes[$column];
          \R::exec("UPDATE `$table` SET `$column` = '$value' WHERE `$table`.`id` = $id;");
        }

        return true;
      }
    }

  public function validate($data) {
    Validator::langDir(WWW . '/validator/lang');
    Validator::lang('ru');
    $v = new Validator($data);
    $v->rules($this->rules);
    if ($v->validate()) {
      return true;
    }
    $this->errors = $v->errors();
    return false;
  }

  public function getErrors() {
    $errors = '<ul>';
    foreach ($this->errors as $error) {
      foreach ($error as $item) {
        $errors .= "<li>$item</li>";
      }
    }
    $errors .= '</ul>';
    $_SESSION['error'] = $errors;
  }
}
