<?php
$this->breadcrumbs = array(
	'Shipments' => array('index'),
	$model->id,
);

$this->menu = array(
	array('label' => 'List Shipment', 'url' => array('index')),
	array('label' => 'New Shipment', 'url' => array('create')),
	array('label' => 'Update Shipment', 'url' => array('update', 'id' => $model->id),'visible' => empty($model->waybill)	),
);

?>

<h1>Order#<?php echo $model->id; ?> Detail</h1>
<div class="row">
	<div class="span5">
		<fieldset>
			<legend>Shipper</legend>
		<?php
		$this->widget('bootstrap.widgets.TbDetailView', array(
			'data' => $model,
			'htmlOptions' => array('class' => 'order_details'), 
			'attributes' => array(
//				'consigneeCompanyName',
//				'consigneeAddress',
//				'consigneeCity',
//				'consigneePostalCode',
//				'consigneeCountryCode',
//				'consigneeCountryName',
//				'consigneePersonName',
//				'consigneePhoneNumber',
//				'consigneePhoneExt',
//				'consigneeFax',
//				'consigneeTelex',
//				'consigneeEmail',
//				'shipmentWeight',
				'shipperCompanyName',
				'shipperAddress',
				'shipperCity',
				'shipperPostalCode',
				'shipperCountryCode',
				'shipperCountryName',
				'shipperPersonName',
				'shipperPhoneNumber',
				'shipperPhoneExt',
				'shipperFax',
				'shipperTelex',
				'shipperEmail',
			),
		));

		?>
		</fieldset>
	</div>
	<div class="span5">
		<fieldset>
			<legend>Consignee</legend>
		<?php
		$this->widget('bootstrap.widgets.TbDetailView', array(
			'data' => $model,
			'htmlOptions' => array('class' => 'order_details'),
			'attributes' => array(
				'consigneeCompanyName',
				'consigneeAddress',
				'consigneeCity',
				'consigneePostalCode',
				'consigneeCountryCode',
				'consigneeCountryName',
				'consigneePersonName',
				'consigneePhoneNumber',
				'consigneePhoneExt',
				'consigneeFax',
				'consigneeTelex',
				'consigneeEmail',
//				'shipmentWeight',
//				'shipperCompanyName',
//				'shipperAddress',
//				'shipperCity',
//				'shipperPostalCode',
//				'shipperCountryCode',
//				'shipperCountryName',
//				'shipperPersonName',
//				'shipperPhoneNumber',
//				'shipperPhoneExt',
//				'shipperFax',
//				'shipperTelex',
//				'shipperEmail',
			),
		));

		?>
		</fieldset>
	</div>
	<div class="span10">
		<?php
		$this->widget('bootstrap.widgets.TbDetailView', array(
			'data' => $model,
			'htmlOptions' => array('class' => 'order_details'),
			'attributes' => array(
				array(
					'lebel' => 'Weight',
					'name' => 'shipmentWeight',
					'value' => $model->shipmentWeight.' KG'
				),
				'waybill',
				array(
					'label' => 'Price',
					'name' => 'upCharge',
					'value' => 'USD '.$model->upCharge
				)
			),
		));

		?>
	</div>
</div>
