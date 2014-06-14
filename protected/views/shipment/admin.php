<?php
$this->breadcrumbs = array(
	'Shipments' => array('index'),
	'Manage',
);

$this->menu = array(
	array('label' => 'Create Shipment', 'url' => array('create')),
);

$this->widget('bootstrap.widgets.TbAlert', array(
	'alerts' => array(
		'success' => array('block' => true, 'fade' => true),
	),
));
?>

<h1>Manage Shipments</h1>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
	'id' => 'shipment-grid',
	'type'=>'striped bordered condensed',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
		array(
			'header' => '#',
			'name' => 'id',
			'htmlOptions' => array('width' => '10%')
		),
		array(
			'header' => 'Created By',
			'type' => 'raw',
			'value' => function($data, $row)
			{
				return $data->user->username;
			}
		),
		array(
			'header' => 'Company',
			'name' => 'company_id',
			'type' => 'raw',
			'filter' => Company::listAllCompanies(),
			'value' => function($data,$row){
				return $data->company->name;
			}
		),
		array(
			'header' => 'XML Validation',
			'htmlOptions' => array('width'=>'105px'),
			'type' => 'raw',
			'value' => function($data,$row){
				 if (!empty($data->waybill))
					 return CHtml::link('xml', Yii::app()->createUrl('shipment/xmlResponse', array('id' => $data->id)),array('target'=>'_blank'));
			}
		),
		array(
			'header' => 'Shipment Validation',
			'name' => 'waybill',
			'htmlOptions' => array('width' => '20%'),
			'type' => 'raw',
			'value' => function($data, $row)
			{
				if (empty($data->waybill))
					return CHtml::link('Create AWB', Yii::app()->createUrl('shipment/createAwb', array('id' => $data->id)));
				else
					return $data->waybill.' | '.CHtml::link('Print PDF', Yii::app()->createUrl('shipment/createPDF', array('id' => $data->id)));
			}
		),
		array(
			'class' => 'bootstrap.widgets.TbButtonColumn',
			'template' => '{view}{update}{delete}',
			'htmlOptions'=>array('style'=>'width: 50px'),
			'buttons' => array(
				'update'=> array(
					'visible' => 'empty($data->waybill)'
				)
			)
		),
	/*
	  'shippingtPaymentType',
	  'billingAccountNumber',
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
	  'commodityCode',
	  'commodityName',
	  'dutiableValue',
	  'dutiableCurrency',
	  'shipperEIN',
	  'referenceId',
	  'referenceType',
	  'numberOfPieces',
	  'currencyCode',
	  'pieceId',
	  'piecePackageType',
	  'pieceWeight',
	  'packageType',
	  'shipmentWeight',
	  'dimensionUnit',
	  'weightUnit',
	  'globalProductCode',
	  'localProductCode',
	  'doorTo',
	  'date',
	  'contents',
	  'isDutiable',
	  'insuredAmmount',
	  'shipperId',
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
	  'xmlRequest',
	  'xmlResponse',
	  'waybill',
	  'barcode1',
	  'barcode2',
	  'barcode3',
	 */
	),
));

?>
