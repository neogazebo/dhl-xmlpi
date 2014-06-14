<?php
$this->breadcrumbs=array(
	'Invoices'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Invoice','url'=>array('admin','company_id'=>$company_id)),
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
?>

<h1>Create Invoice</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('/transaction/_search',array(
	'model'=>$transaction,
)); ?>
</div><!-- search-form -->

<h3>Transaction List</h3>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'cInvoice-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'transaction-grid',
	'type'=>'striped bordered condensed',
	'dataProvider'=>$transaction->search(),
	'filter'=>$transaction,
	'columns'=>array(
		array(
			'name' => 'id',
			'header' => '#',
			'htmlOptions'=>array('style'=>'width: 50px'),
		),
		array(
			'name' => 'charges',
			'header' => 'Charge',
			'type' => 'raw',
			'value'=> function($data,$row){
				return 'USD '.$data->charges;
			}
		),
		array(
			'name'=>'created',
			'header' => 'Created',
			'type' => 'raw',
			'value' => function ($data,$row){
				return date('Y-m-d',$data->created);
			}
		),
		array(
			'class'=>'CFCheckBoxColumn',
			'selectableRows' => 2,
			'checkBoxHtmlOptions' => array('name' => 'TransToInvoice','class'=>'trans_to_invoice')
		),
	),
)); ?>
<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Create',
		)); ?>
	</div>
<?php $this->endWidget(); ?>