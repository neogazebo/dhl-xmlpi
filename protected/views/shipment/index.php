<?php
$this->breadcrumbs=array(
	'Shipments',
);

$this->menu=array(
	array('label'=>'Create Shipment','url'=>array('create')),
	array('label'=>'Manage Shipment','url'=>array('admin')),
);
?>

<h1>Shipments</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
