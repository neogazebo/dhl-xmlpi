<?php
$this->breadcrumbs=array(
	'Shipments'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Create Shipment','url'=>array('create')),
	array('label'=>'Manage Shipment','url'=>array('index')),
);
?>

<h1>Update Shipment #<?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>