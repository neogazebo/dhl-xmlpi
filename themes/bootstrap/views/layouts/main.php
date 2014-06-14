<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="language" content="en" />

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />

		<title><?php echo CHtml::encode($this->pageTitle); ?></title>

		<?php Yii::app()->bootstrap->register(); ?>
	</head>

	<body>

		<?php
		$user = Yii::app()->user;
		$this->widget('bootstrap.widgets.TbNavbar', array(
			'collapse' => true,
			'type' => 'inverse',
			'items' => array(
				array(
					'class' => 'bootstrap.widgets.TbMenu',
					'items' => array(
						array('label' => 'About', 'url' => array('/site/page', 'view' => 'about'), 'visible' => Yii::app()->user->isGuest),
						array('label' => 'Contact', 'url' => array('/site/contact'), 'visible' => Yii::app()->user->isGuest),
						array('label' => 'Cek Rate', 'url' => array('/shipment/cekRate'), 'visible' => $user->checkAccess('user')),
						array('label' => 'Order Management', 'url' => array('order/'), 'visible' => $user->checkAccess('user')),
						array('label' => 'Shipment Management', 'url' => array('shipment/'), 'visible' => $user->checkAccess('admin')),
						array('label' => 'User Management', 'url' => array('user/'), 'visible' => $user->checkAccess('admin')),
						array('label' => 'Company Management', 'url' => array('company/'), 'visible' => $user->checkAccess('admin')),
						array('label' => 'Product Management', 'url' => array('product/'), 'visible' => $user->checkAccess('admin')),
						array(
							'label' => 'Configuration',
							'url' => '#',
							'visible' => $user->checkAccess('admin'),
							'items' => array(
								array(
									'label' => 'Shipper Data',
									'url' => array('/shipment/shipperDataConfiguration'),
									'visble' => $user->checkAccess('admin'),
								),
								array(
									'label' => 'XML Request',
									'url' => array('/XmlConfig/'),
									'visble' => $user->checkAccess('admin'),
								)
							)
						),
					),
				),
				array(
					'class' => 'bootstrap.widgets.TbMenu',
					'htmlOptions' => array('class' => 'pull-right'),
					'items' => array(
						array('label' => ucfirst(Yii::app()->user->name), 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest,'items'=>array(
							array('label' => 'Profile', 'url' => array('/profile/'), 'visible' => !Yii::app()->user->isGuest),
							array('label' => 'Logout', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest)
						))
					),
				),
			),
		));

		?>

		<div class="container" id="page">

			<?php if (isset($this->breadcrumbs)): ?>
				<?php
				$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
					'links' => $this->breadcrumbs,
				));

				?><!-- breadcrumbs -->
			<?php endif ?>

			<?php echo $content; ?>

			<div class="clear"></div>

			<div id="footer">
				Copyright &copy; <?php echo date('Y'); ?> Technolyze.net.<br/>
				All Rights Reserved.<br/>
			</div><!-- footer -->

		</div><!-- page -->

	</body>
</html>
