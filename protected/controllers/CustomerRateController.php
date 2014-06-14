<?php

class CustomerRateController extends Controller
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
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index','delete','create','update'),
				'roles'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($company_id = '')
	{
		$model=new CustomerRate;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$company_name = '';
		$company = Company::model()->findByPk($company_id);
		if(($company instanceof Company))
		{
			$model->company_id = $company->id;
			$company_name = $company->name;
		}

		if(isset($_POST['CustomerRate']))
		{
			$model->attributes=$_POST['CustomerRate'];
			if($model->save())
			{
				Yii::app()->user->setFlash('success', '<strong>Well done!</strong> You successfully created a rate.');
				if(($company instanceof Company))
					$this->redirect(array('company/view','id'=>$company_id));
				else
					$this->redirect(array('index'));
			}
		}

		$this->render('create',array(
			'model'=>$model,
			'company_name' => $company_name
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id,$company_id='')
	{
		$model=$this->loadModel($id);
		$company = Company::model()->findByPk($company_id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['CustomerRate']))
		{
			$model->attributes=$_POST['CustomerRate'];
			if($model->save())
			{
				Yii::app()->user->setFlash('success', '<strong>Well done!</strong> You successfully updated a rate.');
				if($company instanceof Company)
					$this->redirect(array('company/view','id'=>$company->id));
				else
					$this->redirect(array('index'));
			}
				
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
		$model=new CustomerRate('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CustomerRate']))
			$model->attributes=$_GET['CustomerRate'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=CustomerRate::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='customer-rate-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
