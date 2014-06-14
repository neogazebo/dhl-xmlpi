<?php
$this->breadcrumbs=array(
	'Xml Configs'=>array('index'),
	'Manage',
);

$this->menu=array(
);
?>

<h1>Xml Configuration</h1>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'xml-config-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'siteID',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'password',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'shipperAccountNumber',array('class'=>'span5','maxlength'=>15)); ?>

	<?php echo $form->textFieldRow($model,'shippingPaymentType',array('class'=>'span5','maxlength'=>1)); ?>

	<?php echo $form->textFieldRow($model,'billingAccountNumber',array('class'=>'span5','maxlength'=>15)); ?>

	<?php echo $form->textFieldRow($model,'dutyPaymentType',array('class'=>'span5','maxlength'=>1)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
