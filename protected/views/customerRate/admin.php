<?php
$this->breadcrumbs=array(
	'Customer Rates'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create New Rate','url'=>array('create')),
);
?>

<h1>Manage Customer Rates</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'customer-rate-grid',
	'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'name' => 'company_id',
			'type' => 'raw',
			'filter' => Company::listAllCompanies(),
			'value' => function($data,$row){
				return $data->company->name;
			}
		),
		array(
			'name' => 'productId',
			'type' => 'raw',
			'filter' => Product::listAllProducts(),
			'value' => function ($data,$row){
				return $data->product->name;
			}
		),
		'upTo',
		'fixPrice',
		'isActive',
	),
)); ?>
