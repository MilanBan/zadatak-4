<?php

namespace app\models;

use app\core\DbModel;

class User extends DbModel {

  public string $username = '';
  public string $email = '';
  public string $password = '';
  public string $password_confirm = '';

  public function tableName(): string {
    return 'user';
  }

  public function save() {
    $this->password = password_hash( $this->password, PASSWORD_DEFAULT );
    return parent::save();
  }

  public function rules(): array
  {
    return [
      'username'         => [self::RULE_REQUIRED],
      'email'            => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, 'class' =>self::class]],
      'password'         => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8], [self::RULE_MAX, 'max' => 24]],
      'password_confirm' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
    ];
  }

  public function attributes(): array
  {
    return ['username', 'email', 'password'];
  }
}