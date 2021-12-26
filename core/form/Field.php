<?php

namespace app\core\form;

use app\core\Model;

class Field {

  public const TYPE_TEXT = 'text';
  public const TYPE_PASSWORD = 'password';
  public const TYPE_NUMBER = 'number';

  public string $type;
  public Model $model;
  public string $attribute;

  public function __construct( Model $model, string $attribute ) {
    $this->type = self::TYPE_TEXT;
    $this->model = $model;
    $this->attribute = $attribute;
  }

  public function __toString() {

    return sprintf(
      '
        <div class="form-group mb-3">
          <label>%s</label>
          <input type="%s" name="%s" value="%s" class="form-control%s" placeholder="%s">
          <div class="invalid-feedback">
            %s
          </div>
        </div>
      ',
      $this->model->getLabel($this->attribute), //label
      $this->type, // type
      $this->attribute, //name
      $this->model->{$this->attribute}, //value
      $this->model->hasError( $this->attribute ) ? ' is-invalid' : '', // class
      $this->model->getPlaceholder($this->attribute), // placeholder
      $this->model->getFirstError( $this->attribute ) //error
    );
  }

  public function passwordField() {
    $this->type = self::TYPE_PASSWORD;
    return $this;
  }
}