<?php

namespace app\core;

abstract class DbModel extends Model {

  abstract public function tableName(): string;

  abstract public function attributes(): array;

  public function save() {
    $tableName = $this->tableName();
    $attributes = $this->attributes();
    $params = array_map( fn( $attr ) => ":$attr", $attributes );
    $apiKey = implode('-', str_split(substr(strtolower(md5(microtime().rand(1000, 9999))), 0, 30), 6));
    $stmt = self::prepare( "INSERT INTO $tableName (" . implode( ',', $attributes ) . ",api_key)
      VALUES(" . implode( ',', $params ) . ", '$apiKey')" );
    foreach ( $attributes as $attribute ) {
      $stmt->bindValue( ":$attribute", $this->{$attribute} );
    }

    $stmt->execute();
    return true;
  }

  public function prepare( $sql ) {
    return Application::$app->db->pdo->prepare( $sql );
  }
}