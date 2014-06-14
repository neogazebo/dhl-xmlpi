<?php
$this->breadcrumbs = array(
	'Shipments' => array('index'),
	'Cek Rate',
);

$this->menu = array(
	array('label' => 'Create Order', 'url' => array('order/create'))
);

?>

<h1>Cek Rate</h1>

<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id' => 'shipment-form',
	'enableAjaxValidation' => false,
	'action' => Yii::app()->createUrl('shipment/cekRate#rate')
		));

?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<div class="row">
	<div class="span5">
		<fieldset>
			<legend>Shipper Data</legend>
<?php echo $form->textFieldRow($model, 'shipperPostal', array('class' => 'span5', 'maxlength' => 10)); ?>
<?php echo $form->dropDownListRow($model, 'shipperCountry', Shipment::model()->regionAp, array('prompt' => 'Select Country', 'class' => 'span5')); ?>
		</fieldset>
	</div>
	<div class="span5">
		<fieldset>
			<legend>Consignee Data</legend>
<?php echo $form->textFieldRow($model, 'consigneePostal', array('class' => 'span5', 'maxlength' => 10)); ?>
<?php echo $form->dropDownListRow($model, 'consigneeCountry', Shipment::model()->countryList(), array('prompt' => 'Select Country', 'class' => 'span5')); ?>
		</fieldset>
	</div>
</div>
	<?php echo $form->hiddenField($model, 'company_id', array('value' => Yii::app()->user->company_id)); ?>
	<?php echo $form->textFieldRow($model, 'packageWeight') ?>

<div class="form-actions">
	<?php
	$this->widget('bootstrap.widgets.TbButton', array(
		'buttonType' => 'submit',
		'type' => 'primary',
		'label' => 'Submit',
	));
	?>
</div>

<?php $this->endWidget(); ?>

<a id="rate"></a>
<?php
$this->widget('bootstrap.widgets.TbAlert', array(
	'alerts' => array(
		'warning' => array('block' => true, 'fade' => true),
	),
));

$this->widget('bootstrap.widgets.TbGridView', array(
	'id' => 'rates-grid',
	'type' => 'striped bordered condensed',
	'dataProvider' => $rate,
	'columns' => array(
		array(
			'header' => 'Product',
			'name' => 'ProductShortName',
			'value' => function($data, $row)
			{
				return ucfirst($data['ProductShortName']);
			}
		),
		array(
			'header' => 'Transit Days',
			'name' => 'TotalTransitDays',
			'value' => function ($data, $row)
			{
				return ucfirst($data['TotalTransitDays']);
			}
		),
		array(
			'header' => 'Price (USD)',
			'name' => 'ShippingCharge',
			'value' => function($data, $row)
			{
				return ucfirst($data['ShippingCharge']);
			}
		)
	),
));

?>