<?php
$this->breadcrumbs=array(
	'Companies'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Add New Company','url'=>array('create')),
	array('label'=>'Manage Company','url'=>array('index')),
	array('label'=>'Update Company Profile','url'=>array('update','id'=>$model->id)),
	array('label'=>'Add User','url'=>array('user/create','company_id'=>$model->id)),
	array('label'=>'Create Rate','url'=>array('customerRate/create','company_id'=>$model->id)),
	array('label'=>'Manage Invoice','url'=>array('invoice/admin','company_id'=>$model->id)),
);

$this->widget('bootstrap.widgets.TbAlert', array(
	'alerts' => array(
		'success' => array('block' => true, 'fade' => true),
	),
));
?>

<h1><?php echo ucfirst($model->name); ?> Profile</h1>


<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		'address',
		'city',
		'postalCode',
	),
)); ?>
<hr />

<h3>User List</h3>
<?php
$this->widget('bootstrap.widgets.TbGridView', array(
	'id' => 'company_user-grid',
	'template'=>"{items}",
	'type' => 'striped bordered condensed',
	'dataProvider' => $user->search(),
	'filter' => $user,
	'columns' => array(
		'username',
		'email',
		array(
			'header' => 'Status',
			'name' => 'isActive',
			'filter' => User::userStatusList(),
			'htmlOptions' => array('style' => 'width: 90px'),
			'type' => 'raw',
			'value' => function($data, $row)
			{
				return $data->isActive ? 'Active' : 'Not Active';
			}
		),
		array(
			'name' => 'access',
			'header' => 'Last Access',
			'filter' =>false,
			'type' => 'raw',
			'value' => function($data,$row){
				if(!empty($data->access))
					return date('m-d-Y',$data->access);
			}
		),
		array(
			'class' => 'bootstrap.widgets.TbButtonColumn',
			'template' => '{update}{delete}',
			'buttons' => array(
				'update' => array(
					'url' => function ($data,$row)use($model){
						return Yii::app()->createUrl('user/update', array('id'=>$data->id,'company_id'=>$model->id));
					}
				),
				'delete' => array(
					'url' => function ($data,$row){
						return Yii::app()->createUrl('user/delete', array('id'=>$data->id));
					}
				),
			),
			'htmlOptions' => array('style' => 'width: 50px'),
		),
	),
));

?>
<hr />

<h3>Rate List</h3>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'customer-rate-grid',
	'type'=>'striped bordered condensed',
	'dataProvider'=>$rate->search(),
	'template'=>"{items}",
	'filter'=>$rate,
	'columns'=>array(
		array(
			'name' => 'productId',
			'filter' => Product::listAllProducts(),
			'type' => 'raw',
			'value' => function ($data,$row){
				return $data->product->name;
			}
		),
		array(
			'name' => 'upTo',
			'type' => 'raw',
			'value' => function($data,$row){
				return $data->upTo.' %';
			}
		),
//		'fixPrice',
		array(
			'header' => 'Status',
			'name' => 'isActive',
			'filter' => CustomerRate::rateStatusList(),
			'htmlOptions' => array('style' => 'width: 90px'),
			'type' => 'raw',
			'value' => function($data, $row)
			{
				return $data->isActive ? 'Active' : 'Not Active';
			}
		),
		array(
			'class' => 'bootstrap.widgets.TbButtonColumn',
			'template' => '{update}{delete}',
			'buttons' => array(
				'update' => array(
					'url' => function ($data,$row)use($model){
						return Yii::app()->createUrl('customerRate/update', array('id'=>$data->id,'company_id'=>$model->id));
					}
				),
				'delete' => array(
					'url' => function ($data,$row){
						return Yii::app()->createUrl('customerRate/delete', array('id'=>$data->id));
					}
				),
			),
			'htmlOptions'=>array('style'=>'width: 50px'),
		),
	),
)); ?>
