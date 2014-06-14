<?php
$this->breadcrumbs=array(
	'Orders'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Order','url'=>array('index')),
);
?>

<h1>Create Order</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>