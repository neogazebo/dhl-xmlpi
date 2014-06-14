<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'shipment-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<div class="span5">
			<fieldset>
				<legend>Shipper Data</legend>
				<?php echo $form->textFieldRow($model,'shipperCompanyName',array('class'=>'span5','maxlength'=>45)); ?>
				<?php echo $form->textAreaRow($model,'shipperAddress',array('rows'=>6, 'cols'=>50, 'class'=>'span5')); ?>
				<?php echo $form->textFieldRow($model,'shipperCity',array('class'=>'span5')); ?>
				<?php echo $form->textFieldRow($model,'shipperPostalCode',array('class'=>'span5','maxlength'=>10)); ?>
				<?php echo $form->dropDownListRow($model,'shipperCountryCode',Shipment::model()->regionAp,array('prompt'=>'Select Country','class'=>'span5')); ?>
				<?php echo $form->textFieldRow($model,'shipperPersonName',array('class'=>'span5','maxlength'=>40)); ?>
				<?php echo $form->textFieldRow($model,'shipperPhoneNumber',array('class'=>'span5','maxlength'=>30)); ?>
				<?php echo $form->textFieldRow($model,'shipperPhoneExt',array('class'=>'span5','maxlength'=>7)); ?>
				<?php echo $form->textFieldRow($model,'shipperFax',array('class'=>'span5','maxlength'=>30)); ?>
				<?php echo $form->textFieldRow($model,'shipperTelex',array('class'=>'span5','maxlength'=>30)); ?>
				<?php echo $form->textFieldRow($model,'shipperEmail',array('class'=>'span5','maxlength'=>90)); ?>
			</fieldset>
		</div>
		<div class="span5">
			<fieldset>
				<legend>Consignee Data</legend>
				<?php echo $form->textFieldRow($model,'consigneeCompanyName',array('class'=>'span5','maxlength'=>45)); ?>
				<?php echo $form->textAreaRow($model,'consigneeAddress',array('rows'=>6, 'cols'=>50, 'class'=>'span5')); ?>
				<?php echo $form->textFieldRow($model,'consigneeCity',array('class'=>'span5','maxlength'=>45)); ?>
				<?php echo $form->textFieldRow($model,'consigneePostalCode',array('class'=>'span5','maxlength'=>10)); ?>
				<?php echo $form->dropDownListRow($model,'consigneeCountryCode',Shipment::model()->countryList(),array('prompt'=>'Select Country','class'=>'span5')); ?>
				<?php echo $form->textFieldRow($model,'consigneePersonName',array('class'=>'span5','maxlength'=>40)); ?>
				<?php echo $form->textFieldRow($model,'consigneePhoneNumber',array('class'=>'span5','maxlength'=>30)); ?>
				<?php echo $form->textFieldRow($model,'consigneePhoneExt',array('class'=>'span5','maxlength'=>7)); ?>
				<?php echo $form->textFieldRow($model,'consigneeFax',array('class'=>'span5','maxlength'=>30)); ?>
				<?php echo $form->textFieldRow($model,'consigneeTelex',array('class'=>'span5','maxlength'=>30)); ?>
				<?php echo $form->textFieldRow($model,'consigneeEmail',array('class'=>'span5','maxlength'=>90)); ?>
			</fieldset>
		</div>
	</div>
	<?php echo $form->dropdownListRow($model,'productCode',  Product::listAllProducts('code')) ?>
	<?php 
	 echo $form->hiddenField($model,'userId',array('value'=>  Yii::app()->user->id));
	 echo $form->hiddenField($model,'company_id',array('value'=>  Yii::app()->user->company_id));
	 echo $form->hiddenField($model,'numberOfPieces',array('value'=> 1));
	 echo $form->hiddenField($model,'shipmentWeight',array('value'=>  1));
	?>
	
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
