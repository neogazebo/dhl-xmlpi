<?php
$this->breadcrumbs = array(
	'Products' => array('index'),
	'Manage',
);

$this->menu = array(
	array('label' => 'Create Product', 'url' => array('create')),
);

$this->widget('bootstrap.widgets.TbAlert', array(
	'alerts' => array(
		'success' => array('block' => true, 'fade' => true),
	),
));
?>

<h1>Manage Products</h1>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
	'id' => 'product-grid',
	'type' => 'striped bordered condensed',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
		'name',
		'code',
		array(
			'name' => 'handlingFee',
			'type' => 'raw',
			'value' => function($data,$row){
				return $data->handlingFee.' %';			
			}
		),
		array(
			'header' => 'Status',
			'name' => 'isActive',
			'filter' => Product::productStatusList(),
			'type' => 'raw',
			'value' => function($data, $row)
			{
				return $data->isActive ? 'Active' : 'Not Active';
			}
		),
		array(
			'class' => 'bootstrap.widgets.TbButtonColumn',
			'template' => '{update}{delete}',
			'htmlOptions' => array('style' => 'width: 50px'),
		),
	),
));

?>
