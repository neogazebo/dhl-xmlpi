<?php
$this->breadcrumbs = array(
	'Profiles' => array('index'),
	$model->id,
);

$this->menu = array(
	array('label' => 'Update Profile', 'url' => array('update', 'id' => $model->id))
);

$this->widget('bootstrap.widgets.TbAlert', array(
	'alerts' => array(
		'success' => array('block' => true, 'fade' => true),
	),
));

?>

<h1>My Profile</h1>

<?php
$this->widget('bootstrap.widgets.TbDetailView', array(
	'data' => $model,
	'attributes' => array(
		'username',
		'email',
		'isActive',
		'firstName',
		'lastName',
	),
));

?>
