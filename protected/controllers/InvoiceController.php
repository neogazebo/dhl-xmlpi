<?php

class InvoiceController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',
				'actions' => array('create', 'update', 'index', 'delete', 'admin','view'),
				'roles' => array('admin'),
			),
			array('deny',
				'users' => array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param type $id
	 * @param type $company_id
	 * @throws CHttpException
	 */
	public function actionView($id,$company_id)
	{
		$company = Company::model()->findByPk($company_id);
		if(!($company instanceof Company))
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		
		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'company_id'=>$company->id
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($company_id)
	{
		$model=new Invoice;
		$company = Company::model()->findByPk($company_id);
		if(!($company instanceof Company))
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		
		$transaction = new Transaction('search');
		$transaction->unsetAttributes();
		if(isset($_GET['Transaction']))
			$transaction->attributes=$_GET['Transaction'];
		
		$transaction->company_id = $company_id;
		$transaction->invoiceId = 0;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TransToInvoice']))
		{
			$model->company_id = $company_id;
			try
			{
				$trans = Yii::app()->db->beginTransaction();
				if($model->save())
				{
					$totalCharge = 0;
					foreach ($_POST['TransToInvoice'] as $key)
					{
						$transToInvoice = Transaction::model()->findByPk($key['id']);
						$transToInvoice->setScenario('invoice');
						if(!($transToInvoice instanceof Transaction))
						{
							throw new NoTransException(400,'Cannot Create Invoce, please contact your administrator.');
						}
						
						$transToInvoice->invoiceId = $model->id;
						if(!$transToInvoice->save(false))
							throw new NoTransException(400,'Cannot Create Invoce, please contact your administrator.');
						
						$totalCharge = $totalCharge + $transToInvoice->charges;
					}
					$model->charges = $totalCharge;
					if($model->save())
					{
						$trans->commit();
						Yii::app()->user->setFlash('success', '<strong>Well done!</strong> You successfully created an invoice.');
						$this->redirect(array('admin','company_id'=>$company_id));
					}
					else
						throw new NoTransException(400,'Cannot Create Invoce, please contact your administrator.');
				}
				else
					throw new NoTransException(400,'Cannot Create Invoce, please contact your administrator.');
			}
			catch (NoTransException $e)
			{
				$trans->rollback();
				throw $e;
			}
		}

		$this->render('create',array(
			'model'=>$model,
			'company_id'=>$company->id,
			'transaction'=>$transaction
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Invoice']))
		{
			$model->attributes=$_POST['Invoice'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Invoice');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin($company_id)
	{
		$model=new Invoice('search');
		$company = Company::model()->findByPk($company_id);
		
		if(!($company instanceof Company))
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Invoice']))
			$model->attributes=$_GET['Invoice'];
		$model->company_id = $company_id;

		$this->render('admin',array(
			'model'=>$model,
			'company_id'=>$company_id
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Invoice::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='invoice-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

class NoTransException extends CException{}
