<?php
$this->breadcrumbs=array(
	'Shipments'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Shipment','url'=>array('index')),
);
?>

<h1>Create Shipment</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>