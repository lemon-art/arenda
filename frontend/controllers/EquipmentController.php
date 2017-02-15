<?php

namespace frontend\controllers;

use Yii;
use app\models\Equipment;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use creocoder\nestedsets\NestedSetsBehavior;

/**
 * EquipmentController implements the CRUD actions for Equipment model.
 */
class EquipmentController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Equipment models.
     * @return mixed
     */
    public function actionIndex()
    {
		$model = new Equipment();
		$arSections = Equipment::find()->asArray()->where(['section' => 1])->all(); 
		$title = "Товары";
		
		if(isset($_GET['equipment_id'])){
		
			$dataProvider = new ActiveDataProvider([
				'query' => Equipment::find()->where(['type' => $_GET['equipment_id']])->andWhere(['section' => 0]),
			]);
			$title = $this->findModel($_GET['equipment_id'])->name;
		}
		else {
			$dataProvider = new ActiveDataProvider([
				'query' => Equipment::find()->where(['section' => 0]),
			]);
		}
		
		if (Yii::$app->request->isAjax) {
			return $this->renderAjax('index', [
				'dataProvider' => $dataProvider,
				'arSections' => $model->get_tree( $arSections, 0 ),
				'title' => $title
			]);
		}
		else {
			return $this->render('index', [
				'dataProvider' => $dataProvider,
				'arSections' => $model->get_tree( $arSections, 0 ),
				'title' => $title
			]);
		}
    }
	
	
    /**
     * Displays a single Equipment model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Equipment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Equipment();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->equipment_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
	
	public function actionCreatecategory(  )
    {
        $model = new Equipment();
		if (Yii::$app->request->isAjax) {
			$equipment_id = Yii::$app->request->get('equipment_id');
		}
	
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'equipment_id' => $model->equipment_id]);
        } else {
            return $this->renderPartial('createcategory', [
                'model' => $model,
				'type' => $equipment_id
            ]);
        }
    }

    /**
     * Updates an existing Equipment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		

       if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'equipment_id' => $model->type]);
        } else {

			return $this->renderPartial('update',array('model'=>$model), false, true);
            
        }
    }
	
	 public function actionUpdatecategory( $equipment_id = 0)
    {
        
		
		if (Yii::$app->request->isAjax) {
			$equipment_id = Yii::$app->request->get('equipment_id');
		}
		
		$model = $this->findModel($equipment_id);

       if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'equipment_id' => $model->equipment_id]);
        } else {

			return $this->renderPartial('updatecategory',array('model'=>$model), false, true);
            
        }
    }

    /**
     * Deletes an existing Equipment model.
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
     * Finds the Equipment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Equipment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Equipment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

class CategoryQuery extends \yii\db\ActiveQuery
{
    public function behaviors() {
        return [
            NestedSetsQueryBehavior::className(),
        ];
    }
}
