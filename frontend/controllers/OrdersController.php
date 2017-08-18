<?php

namespace frontend\controllers;

use Yii;
use app\models\Orders;
use app\models\OrdersSearch;
use app\models\ClientStorage;
use app\models\StorageOperation;
use app\models\Payment;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class OrdersController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Orders models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrdersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	public function actionExpired()
    {
        $searchModel = new OrdersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Displays a single Orders model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
	
		$model = $this->findModel($id);
		$arEqip = ClientStorage::find()->asArray()->with('equipment')->where(['order_id' => $id])->all(); 
		$arOperations = StorageOperation::find()->asArray()->with('equipment')->where(['order_id' => $id])->orderBy(['operation_date' => SORT_DESC])->all(); 
		$arPayments = Payment::find()->asArray()->where(['order_id' => $id])->orderBy(['data' => SORT_DESC])->all(); 

		
        return $this->render('view', [
            'model' => $model,
			'arEqip' => $arEqip,
			'arOperations' => $arOperations,
			'arPayments' => $arPayments,
        ]);
    }
	
    /**
     * Creates a new Orders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Orders();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			
			
			if(is_array($_POST['eq'])){
				//сохраняем данные о товарах
				foreach( $_POST['eq'] as $eqID => $eqVal ){
					$cStorage = new ClientStorage;
					$cStorage -> order_id  		= $model->order_id;
					$cStorage -> storage_id 	= $_POST['Orders']['storage_id'];
					$cStorage -> equipment_id 	= $eqID;
					$cStorage -> count 			= $eqVal;
					$cStorage -> returned 		= 0;
					$cStorage -> client_type	= 'person';
					$cStorage -> client_id		= $model->person_id;
					$cStorage -> save();
					
					//созраняем в историю операций
					$cStorage = new StorageOperation;
					$cStorage -> order_id  		= $model->order_id;
					$cStorage -> storage_id 	= $_POST['Orders']['storage_id'];
					$cStorage -> equipment_id 	= $eqID;
					$cStorage -> count 			= $eqVal;
					$cStorage -> operation_type	= 'lease';
					$cStorage -> user_id		= Yii::$app->user->identity->id;
					$cStorage -> save();
					
					
				}
				
			}
			
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
	

	

    /**
     * Updates an existing Orders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
		
			if(is_array($_POST['eq'])){
				//сохраняем данные о товарах
				foreach( $_POST['eq'] as $eqID => $eqVal ){
					$cStorage = null;
					if ( $cStorage = ClientStorage::findModel($model->order_id, $eqID, $_POST['Orders']['storage_id'])){
						


						$oldCount = $cStorage->count;
						$cStorage->count = $eqVal;
						$cStorage -> save();
						$operation_count = $eqVal - $oldCount;
						if ( $operation_count !==0){
							if ( $operation_count < 0 ){
								$operation_type = 'delete';
								$operation_count = $oldCount - $eqVal;
							}
							else {
								$operation_type = 'lease';
							}
							
							//созраняем в историю операций
							$cStorageOp = new StorageOperation;
							$cStorageOp -> order_id  		= $model->order_id;
							$cStorageOp -> storage_id 	= $_POST['Orders']['storage_id'];
							$cStorageOp -> equipment_id 	= $eqID;
							$cStorageOp -> count 			= $operation_count;
							$cStorageOp -> operation_type	= $operation_type;
							$cStorageOp -> user_id		= Yii::$app->user->identity->id;
							$cStorageOp -> save();
						}
						if ( $eqVal == 0 && $cStorage->returned == 0 ){ 	//если нулевое значение значит удаляем запись
							$cStorage->delete();
						}
						
					}
					else{
						
						$cStorage = new ClientStorage;
						$cStorage -> order_id  		= $model->order_id;
						$cStorage -> storage_id 	= $_POST['Orders']['storage_id'];
						$cStorage -> equipment_id 	= $eqID;
						$cStorage -> count 			= $eqVal;
						$cStorage -> client_type	= 'person';
						$cStorage -> client_id		= $model->person_id;
						$cStorage -> save();
						
						//созраняем в историю операций
						$cStorage = new StorageOperation;
						$cStorage -> order_id  		= $model->order_id;
						$cStorage -> storage_id 	= $_POST['Orders']['storage_id'];
						$cStorage -> equipment_id 	= $eqID;
						$cStorage -> count 			= $eqVal;
						$cStorage -> operation_type	= 'lease';
						$cStorage -> user_id		= Yii::$app->user->identity->id;
						$cStorage -> save();
					}

				}
				$model->save();
			}
		
            return $this->redirect(['view', 'id' => $model->order_id]);
			//return false;
        } else {

			$arEqip = ClientStorage::find()->asArray()->with('equipment')->where(['order_id' => $id])->all(); 

			return $this->render('update', [
				'model' => $model,
				'arEqip' => $arEqip
			]);
        }
    }
	
	
	
	
	public function actionReturn($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
			if(is_array($_POST['eq'])){
				//сохраняем данные о товарах
				foreach( $_POST['eq'] as $eqID => $eqVal ){
					$cStorage = null;
					if ( $cStorage = ClientStorage::findModel($model->order_id, $eqID, $_POST['Orders']['storage_id'])){
						
						$oldCount = $cStorage->count;
						$oldReturned = $cStorage->returned;
						$cStorage->count = $oldCount - $eqVal;	//уменьшаем кол-во товара в наличии у клиента
						$cStorage->returned = $oldReturned + $eqVal;	//увеличиваем кол-во возвращенного товара 
						$cStorage -> save();
							
							//сохраняем в историю операций
							$cStorageOp = new StorageOperation;
							$cStorageOp -> order_id  		= $model->order_id;
							$cStorageOp -> storage_id 	    = $model->storage_id;
							$cStorageOp -> equipment_id 	= $eqID;
							$cStorageOp -> count 			= $eqVal;
							$cStorageOp -> operation_type	= 'debtor';
							$cStorageOp -> user_id		    = Yii::$app->user->identity->id;
							$cStorageOp -> save();
					}

						
				}
			}
			return $this->redirect(['view', 'id' => $model->order_id]);
		}
		else {

			$arEqip = ClientStorage::find()->asArray()->with('equipment')->where(['order_id' => $id])->all(); 

			return $this->render('return', [
				'model' => $model,
				'arEqip' => $arEqip
			]);
        }
    }
	
	
	
	public function actionReturnall($id)
    {
        $model = $this->findModel($id);

		$arEqips = ClientStorage::find()->asArray()->where(['order_id' => $id])->all();
		
		foreach ( $arEqips as $arEqip){
			$cStorage = ClientStorage::findModel($model->order_id, $arEqip['equipment_id'], $model->storage_id);
			
			$oldCount = $cStorage->count;
			
			if ( $oldCount > 0 ){
			
				$oldReturned = $cStorage->returned;
				$cStorage->count = 0;	//уменьшаем кол-во товара в наличии у клиента
				$cStorage->returned = $oldReturned + $oldCount;	//увеличиваем кол-во возвращенного товара 
				$cStorage -> save();
				
				//сохраняем в историю операций
				$cStorageOp = new StorageOperation;
				$cStorageOp -> order_id  		= $model->order_id;
				$cStorageOp -> storage_id 	    = $model->storage_id;
				$cStorageOp -> equipment_id 	= $arEqip['equipment_id'];
				$cStorageOp -> count 			= $oldCount;
				$cStorageOp -> operation_type	= 'debtor';
				$cStorageOp -> user_id		    = Yii::$app->user->identity->id;
				$cStorageOp -> save();
			}
			
		}
		
		return $this->redirect(['view', 'id' => $model->order_id]);
		
    }

    /**
     * Deletes an existing Orders model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Orders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Orders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Orders::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
