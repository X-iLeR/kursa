<?php
/* @var $this UserController */
/* @var $user User */
/* @var $form CActiveForm */
/* @var $formClass RegistrationForm */
?>
<?php  Helpers::echoErrorSuccessFlashes(); ?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-register-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Поля, помеченные <span class="required">*</span> обязательны.</p>

    <?php echo $form->errorSummary($formClass); ?>


    <div class="row">
		<?php echo $form->labelEx($formClass,'name'); ?>
		<?php echo $form->textField($formClass,'name'); ?>
		<?php echo $form->error($formClass,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($formClass,'pwd1'); ?>
		<?php echo $form->passwordField($formClass,'pwd1'); ?>
		<?php echo $form->error($formClass,'pwd1'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($formClass,'pwd2'); ?>
        <?php echo $form->passwordField($formClass,'pwd2'); ?>
        <?php echo $form->error($formClass,'pwd2'); ?>
    </div>

    <?php if(CCaptcha::checkRequirements()): ?>
        <div class="row">
            <?php echo $form->labelEx($formClass,'verifyCode'); ?>
            <div>
                <?php $this->widget('CCaptcha'); ?>
                <?php echo $form->textField($formClass,'verifyCode'); ?>
            </div>
            <div class="hint">Введите символы с картинки.</div>
            <?php echo $form->error($formClass,'verifyCode'); ?>
        </div>
    <?php endif; ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->