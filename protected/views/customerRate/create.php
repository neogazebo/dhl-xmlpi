<?php
$this->breadcrumbs=array(
	'Customer Rates'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Rate','url'=>array('index')),
);
?>

<h1>Create <?php echo isset($model->company_id) ? $company_name : '' ?> Rate</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>