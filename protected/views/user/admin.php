<?php
$this->breadcrumbs = array(
	'Users' => array('index'),
	'Manage',
);

$this->menu = array(
	array('label' => 'Create User', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('user-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
$this->widget('bootstrap.widgets.TbAlert', array(
	'alerts' => array(
		'success' => array('block' => true, 'fade' => true),
	),
));
?>

<h1>Manage Users</h1>

<p>
	You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
	or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button btn')); ?>
<div class="search-form" style="display:none">
	<?php
	$this->renderPartial('_search', array(
		'model' => $model,
	));

	?>
</div><!-- search-form -->

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
	'id' => 'user-grid',
	'type' => 'striped bordered condensed',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
		'username',
		'email',
		array(
			'header' => 'Company',
			'name'=>'company_id',
			'type' => 'raw',
			'filter'=>  Company::listAllCompanies(),
			'value' => function ($data, $row)
			{
				return $data->company->name;
			}
		),
		array(
			'header' => 'Status',
			'name' => 'isActive',
			'htmlOptions' => array('style' => 'width: 90px'),
			'type' => 'raw',
			'filter' => User::userStatusList(),
			'value' => function($data, $row)
			{
				return $data->isActive ? 'Active' : 'Not Active';
			}
		),
		array(
			'name' => 'access',
			'header' => 'Last Access',
			'type' => 'raw',
			'filter'=>false,
			'value' => function($data, $row)
			{
				if (!empty($data->access))
					return date('m-d-Y', $data->access);
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
