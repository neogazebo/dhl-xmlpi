<?php
$this->breadcrumbs=array(
	'Invoices'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Invoice','url'=>array('index')),
	array('label'=>'Create Invoice','url'=>array('create','company_id'=>$company_id)),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('invoice-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
$this->widget('bootstrap.widgets.TbAlert', array(
	'alerts' => array(
		'warning' => array('block' => true, 'fade' => true),
		'success' => array('block' => true, 'fade' => true),
	),
));
?>

<h1>Manage Invoices</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'invoice-grid',
	'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		array(
			'name'=>'created',
			'type'=>'raw',
			'value'=>function($data,$row){
				return date('Y-m-d',$data->created);
			}
		),
		array(
			'name'=>'paymentDate',
			'type'=>'raw',
			'value'=>function($data,$row){
				return !($data->paymentDate) ? '': date('Y-m-d',$data->paymentDate);
			}
		),
		array(
			'name' => 'charges',
			'type'=>'raw',
			'value'=>function($data,$row){
				return 'USD '.$data->charges;
			}
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template' => '{view}{delete}',
			'buttons'=>array(
				'delete'=>array('visible'=>'!($data->paymentDate)'),
				'view'=>array('url'=> function($data,$row)use($company_id){
						return Yii::app()->createUrl('invoice/view', array('id'=>$data->id,'company_id'=>$company_id));
					}
				)
			)
		),
	),
)); ?>
