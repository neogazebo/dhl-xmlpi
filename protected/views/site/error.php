<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>

<h2>Error <?php echo $code; ?></h2>

<div class="alert alert-error">
  <strong>Code : <?php echo $code; ?></strong> <?php echo CHtml::encode($message); ?>
</div>
