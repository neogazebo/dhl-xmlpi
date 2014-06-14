<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'company-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>80)); ?>
	<?php echo $form->textFieldRow($model,'address',array('class'=>'span5')); ?>
	<?php echo $form->textFieldRow($model,'city',array('class'=>'span5')); ?>
	<?php echo $form->textFieldRow($model,'postalCode'); ?>
	<?php echo $form->dropDownListRow($model,'countryCode',  Shipment::model()->regionAp); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>