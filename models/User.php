<?php

namespace app\models;

use app\core\DbModel;

class User extends DbModel {

  public string $username = '';
  public string $email = '';
  public string $password = '';
  public string $password_confirm = '';

  public static function tableName(): string {
    return 'user';
  }

  public static function primaryKey(): string {
    return 'id';
  }

  public function save() {
    $this->password = password_hash( $this->password, PASSWORD_DEFAULT );
    return parent::save();
  }

  public function rules(): array
  {
    return [
      'username'         => [self::RULE_REQUIRED],
      'email'            => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, 'class' => self::class]],
      'password'         => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8], [self::RULE_MAX, 'max' => 24]],
      'password_confirm' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
    ];
  }

  public function attributes(): array
  {
    return ['username', 'email', 'password'];
  }

  public function labels(): array
  {
    return [
      'username'         => 'Username',
      'email'            => 'Email',
      'password'         => 'Password',
      'password_confirm' => 'Confirm password',
    ];
  }

  public function placeHolders(): array
  {
    return [
      'username'         => 'Enter your username',
      'email'            => 'Enter your email address',
      'password'         => 'Enter your password',
      'password_confirm' => 'Confirm your password',
    ];
  }
}