<?php
$this->breadcrumbs=array(
	'Companies'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create Company','url'=>array('create')),
);
$this->widget('bootstrap.widgets.TbAlert', array(
	'alerts' => array(
		'success' => array('block' => true, 'fade' => true),
	),
));
?>

<h1>Manage Companies</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'company-grid',
	'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'name',
		array(
			'name'=>'created',
			'type'=>'raw',
			'value'=>function($data,$row){
				if(!empty($data->created))
					return date('m-d-Y',$data->created);
			}
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'htmlOptions'=>array('style'=>'width: 50px'),
		),
	),
)); ?>
