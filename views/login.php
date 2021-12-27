<?php
/** @var $model \app\models\User  */

use app\core\form\Form;

$this->title = 'Login';

?>

<h1>Login page</h1>

<?php $form = Form::begin( '', "post" )?>

  <?php echo $form->field( $model, 'email' ) ?>
  <?php echo $form->field( $model, 'password' )->passwordField() ?>

  <button type="submit" class="btn btn-primary">Submit</button>

<?php echo Form::end() ?>

