<?php
$this->breadcrumbs=array(
	'Invoices'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Invoice','url'=>array('admin','company_id'=>$company_id)),
);
?>

<h1>View Invoice #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'created',
		'paymentDate',
		'dueDate',
		'charges',
	),
)); ?>
