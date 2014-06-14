<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'consigneeCompanyName',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textAreaRow($model,'consigneeAddress',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'consigneeCity',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'consigneePostalCode',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'consigneeCountryCode',array('class'=>'span5','maxlength'=>5)); ?>

	<?php echo $form->textFieldRow($model,'consigneeCountryName',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'consigneePersonName',array('class'=>'span5','maxlength'=>40)); ?>

	<?php echo $form->textFieldRow($model,'consigneePhoneNumber',array('class'=>'span5','maxlength'=>30)); ?>

	<?php echo $form->textFieldRow($model,'consigneePhoneExt',array('class'=>'span5','maxlength'=>7)); ?>

	<?php echo $form->textFieldRow($model,'consigneeFax',array('class'=>'span5','maxlength'=>30)); ?>

	<?php echo $form->textFieldRow($model,'consigneeTelex',array('class'=>'span5','maxlength'=>30)); ?>

	<?php echo $form->textFieldRow($model,'consigneeEmail',array('class'=>'span5','maxlength'=>90)); ?>

	<?php echo $form->textFieldRow($model,'numberOfPieces',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'pieceWeight',array('class'=>'span5','maxlength'=>12)); ?>

	<?php echo $form->textFieldRow($model,'packageType',array('class'=>'span5','maxlength'=>12)); ?>

	<?php echo $form->textFieldRow($model,'shipperCompanyName',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textAreaRow($model,'shipperAddress',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textAreaRow($model,'shipperCity',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'shipperPostalCode',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'shipperCountryCode',array('class'=>'span5','maxlength'=>5)); ?>

	<?php echo $form->textFieldRow($model,'shipperCountryName',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'shipperPersonName',array('class'=>'span5','maxlength'=>40)); ?>

	<?php echo $form->textFieldRow($model,'shipperPhoneNumber',array('class'=>'span5','maxlength'=>30)); ?>

	<?php echo $form->textFieldRow($model,'shipperEmail',array('class'=>'span5','maxlength'=>90)); ?>

	<?php echo $form->textFieldRow($model,'waybill',array('class'=>'span5','maxlength'=>90)); ?>


	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
