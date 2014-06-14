<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<?php 
		if($model->getScenario() == 'insert')
			$usernameHtmlOpt = array('class'=>'span5','maxlength'=>50,'autocomplete'=>'off');
		else if($model->getScenario() == 'update')
			$usernameHtmlOpt = array('class'=>'span5','maxlength'=>50,'disabled'=>true,'autocomplete'=>'off');
	?>

	<?php echo $form->textFieldRow($model,'username',$usernameHtmlOpt); ?>
	<?php if($model->getScenario() == 'insert'): echo $form->passwordFieldRow($model,'password',array('class'=>'span5','maxlength'=>20)); endif;?>
	<?php if($model->getScenario() == 'update'): echo $form->passwordFieldRow($model,'newPassword',array('class'=>'span5','maxlength'=>20,'autocomplete'=>'off')); endif;?>
	<?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>50)); ?>
	<?php
	if(isset($model->company_id))
		echo $form->hiddenField($model, 'company_id');
	else
		echo $form->dropDownListRow($model, 'company_id', Company::listAllCompanies(),array('prompt'=>'Select Company')); ?>
	<?php echo $form->dropDownListRow($model, 'isActive', User::userStatusList()); ?>
	<?php echo $form->dropDownListRow($model, 'roles', User::userRolesList()); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
