<?php
$this->breadcrumbs=array(
	'Customer Rates'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CustomerRate','url'=>array('index')),
	array('label'=>'Create CustomerRate','url'=>array('create')),
	array('label'=>'View CustomerRate','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage CustomerRate','url'=>array('admin')),
);
?>

<h1>Update CustomerRate <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>