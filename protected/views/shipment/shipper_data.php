<?php
$this->breadcrumbs=array(
	'Shipper Data Configuration'=>array('shipperDataConfiguration'),
	'Manage',
);

$this->menu=array(
//	array('label'=>'Create Company','url'=>array('create')),
//	array('label'=>'Manage Company','url'=>array('index')),
);
?>

<h1>Shipper Data Configuration</h1>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'shipper_data-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php 
		echo $form->hiddenField($model,'userId',array('value'=>  Yii::app()->user->id));
		echo $form->hiddenField($model,'company_id',array('value'=>  Yii::app()->user->company_id));
	?>
	<?php echo $form->textFieldRow($model,'companyName',array('class'=>'span5','maxlength'=>45)); ?>
	<?php echo $form->textAreaRow($model,'address',array('rows'=>4, 'cols'=>20, 'class'=>'span5')); ?>
	<?php echo $form->textFieldRow($model,'city',array('class'=>'span5','maxlength'=>45)); ?>
	<?php echo $form->textFieldRow($model,'postalCode',array('class'=>'span5','maxlength'=>10)); ?>
	<?php echo $form->textFieldRow($model,'countryCode',array('class'=>'span5','maxlength'=>5)); ?>
	<?php echo $form->textFieldRow($model,'countryName',array('class'=>'span5','maxlength'=>10)); ?>
	<?php echo $form->textFieldRow($model,'personName',array('class'=>'span5','maxlength'=>40)); ?>
	<?php echo $form->textFieldRow($model,'phoneNumber',array('class'=>'span5','maxlength'=>30)); ?>
	<?php echo $form->textFieldRow($model,'phoneExt',array('class'=>'span5','maxlength'=>7)); ?>
	<?php echo $form->textFieldRow($model,'fax',array('class'=>'span5','maxlength'=>30)); ?>
	<?php echo $form->textFieldRow($model,'telex',array('class'=>'span5','maxlength'=>30)); ?>
	<?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>90)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

