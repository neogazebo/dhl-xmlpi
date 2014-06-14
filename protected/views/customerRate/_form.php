<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'customer-rate-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	<?php if($model->getScenario() == 'insert'):?>
	<?php 
		if(isset($model->company_id))
		echo $form->hiddenField($model, 'company_id');
	else
		echo $form->dropDownListRow($model, 'company_id', Company::listAllCompanies(),array('prompt'=>'Select Company')); 
	?>
	<?php echo $form->dropdownListRow($model,'productId',  Product::listAllProducts(),array('prompt'=>'Select Product')); ?>
	<?php elseif($model->getScenario() == 'update'): ?>
	<?php echo $form->dropdownListRow($model,'company_id',Company::listAllCompanies(),array('disabled'=>true)); ?>
	<?php echo $form->dropdownListRow($model,'productId',  Product::listAllProducts(),array('disabled'=>true)); ?>
	<?php echo $form->hiddenField($model,'company_id'); ?>
	<?php echo $form->hiddenField($model,'productId'); ?>
	<?php endif; ?>
	<?php echo $form->textFieldRow($model,'upTo',array('class'=>'span5')); ?>
	<?php echo $form->textFieldRow($model,'fixPrice',array('class'=>'span5')); ?>
	<?php echo $form->dropdownListRow($model,'isActive',CustomerRate::rateStatusList()); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
