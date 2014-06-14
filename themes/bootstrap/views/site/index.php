<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
$user = Yii::app()->user;
?>

<?php $this->beginWidget('bootstrap.widgets.TbHeroUnit',array(
    'heading'=>CHtml::encode(Yii::app()->name).' Shipment Application',
)); ?>

<?php if($user->checkAccess('user')): ?>
<p>Congratulations! You can create or manage your order here</p>
<?php elseif($user->checkAccess('admin')): ?>
<p>Congratulations! You can create or manage your customer here</p>
<?php endif; ?>
<?php $this->endWidget(); ?>

<h3>Dasboard Page</h3>

<p></p>