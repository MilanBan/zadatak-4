<?php
/** @var $model \app\models\User  */

use app\core\form\Form;
?>

<h1>Register page</h1>

<?php $form = Form::begin( '', "post" )?>

  <?php echo $form->field( $model, 'username' ) ?>
  <?php echo $form->field( $model, 'email' ) ?>
  <?php echo $form->field( $model, 'password' )->passwordField() ?>
  <?php echo $form->field( $model, 'password_confirm' )->passwordField() ?>

  <button type="submit" class="btn btn-primary">Submit</button>

<?php echo Form::end() ?>

