<?php

class ShipmentController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = '//layouts/column2';

	/**
	 * @return array action filters
	 * 
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	public function accessRules()
	{
		return array(
			array(
				'allow',
				'actions' => array('createAwb', 'xmlResponse', 'createPDF', 'createAwb', 'cekRate'),
				'roles' => array('admin', 'user'),
			),
			array('allow',
				'actions' => array('create', 'update', 'index', 'delete', 'shipperDataConfiguration','view'),
				'roles' => array('admin'),
			),
			array('deny',
				'users' => array('*'),
			),
		);
	}
	
	public function actionShipperDataConfiguration()
	{
		$model = AddressBook::model()->findByPk(Shipment::SHIPPER_DATA_ADDRESS);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['AddressBook']))
		{
			$model->attributes = $_POST['AddressBook'];
			if ($model->save())
			{
					Yii::app()->user->setFlash('success', '<strong>Congratulations!</strong> You successfully updated shipper data configuration');
				$this->redirect(array('index'));
			}
		}

		$this->render('shipper_data', array(
			'model' => $model,
		));
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view', array(
			'model' => $this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new Shipment;
		$user = User::model()->findByPk(Yii::app()->user->id);
		if (($user instanceof User))
		{
			$model->shipperCompanyName = $user->company->name;
			$model->shipperPersonName = $user->firstName;
			$model->shipperAddress = $user->company->address;
			$model->shipperCity = 'Jakarta';
			$model->shipperCountryCode = 'ID';
			$model->shipperCountryName = 'Indonesia';
			$model->shipperEmail = $user->email;
		}

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Shipment']))
		{
			$model->attributes = $_POST['Shipment'];
			if ($model->save())
				$this->redirect(array('index'));
		}

		$this->render('create', array(
			'model' => $model,
		));
	}

	public function actionCreateAwb($id, $order = 0)
	{
		$model = $this->pageValidationModel($id);
		if (empty($model->waybill))
		{
			$sendxml = new XMLSender();
			$model->onCreateWaybill = array($sendxml, 'send');
			$model->generateXmlRequest();

			if (!$model->xmlResponse)
				throw new CHttpException(400, 'Invalid request. Please contact your administrator.');

			$xmlObjResponse = simplexml_load_string($model->xmlResponse);

			if (isset($xmlObjResponse->AirwayBillNumber))
			{
				try 
				{
					$trans = Yii::app()->db->beginTransaction();
					$model->setScenario('createWaybill');
					$model->charge = $xmlObjResponse->ShippingCharge;
					$model->upCharge = CustomerRate::calculateRate($model->company_id, $model->productCode, $model->charge);
					$model->waybill = $xmlObjResponse->AirwayBillNumber;
					$model->barcode1 = $xmlObjResponse->Barcodes->AWBBarCode;
					$model->barcode2 = $xmlObjResponse->Barcodes->OriginDestnBarcode;
					$model->barcode3 = $xmlObjResponse->Barcodes->DHLRoutingBarCode;

					if($model->save(false))
					{
						$trans->commit();
						Yii::app()->user->setFlash('success', '<strong>Congratulations!</strong> You successfully created the airwaybill');
						if ($order)
							$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('order/index'));
						else
							$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
					}
					else
						throw new CDbException();
				}
				catch (CDbException $e)
				{
					$trans->rollback();
					throw new CDbException(400, 'There is an error, please contact your administrator');
				}
			}
			else
			{
				Yii::app()->user->setFlash('error', '<strong>Error!</strong> Change a few things up and try submitting again.');
				if ($order)
					$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('order/index'));
				else
					$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
			}
		}
	}

	public function actionXmlResponse($id)
	{
		$model = $this->pageValidationModel($id);
		if (!empty($model->waybill))
		{
			header('Content-type: text/xml');
			echo $model->xmlResponse;
			exit;
		}
	}

	public function actionCreatePDF($id)
	{
		$model = $this->pageValidationModel($id);
		$model->generatePdf($model);
	}

	public function pageValidationModel($id)
	{
		if (is_numeric($id))
			$model = $this->loadModel($id);
		else
			throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');

		return $model;
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);

		if(!empty($model->waybill))
			throw new CHttpException(403, 'Cannot update this order because the waybill has been created');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Shipment']))
		{
			$model->attributes = $_POST['Shipment'];
			if ($model->save())
				$this->redirect(array('index'));
		}

		$this->render('update', array(
			'model' => $model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if (Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if (!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$model = new Shipment('search');
		$model->unsetAttributes(); // clear any default values
		if (isset($_GET['Shipment']))
			$model->attributes = $_GET['Shipment'];

		$this->render('admin', array(
			'model' => $model,
		));
	}

	public function actionCekRate()
	{

		$model = new CekRate;
		$rate = new CArrayDataProvider(array());

		if (isset($_POST['CekRate']))
		{
			$model->attributes = $_POST['CekRate'];
			if ($model->validate())
			{
				$sendxml = new XMLSender();
				$model->onCekRate = array($sendxml, 'send');
				$model->generateXmlRequest();

				$xmlObjResponse = simplexml_load_string($model->xmlResponse);
				if (isset($xmlObjResponse->GetQuoteResponse->BkgDetails))
				{
					$arr = (array) $xmlObjResponse->GetQuoteResponse->BkgDetails->children();

					$arrRate = $model->filterAvailableProduct($arr);
					$rate = new CArrayDataProvider($arrRate, array(
								'keyField' => 'ProductShortName'
							));
				}
				else
				{
					Yii::app()->user->setFlash('warning', '<strong>Warning!</strong> No Service Available in this area.');
				}
			}
		}

		$this->render('cekrate', array(
			'model' => $model,
			'rate' => $rate
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model = Shipment::model()->findByPk($id);
		if ($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'shipment-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
