<?php

namespace app\controllers;

use Yii;
use app\models\StorageConsist;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StorageConsistController implements the CRUD actions for StorageConsist model.
 */
class StorageConsistController extends Controller
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
     * Lists all StorageConsist models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => StorageConsist::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StorageConsist model.
     * @param integer $storage_id
     * @param integer $equipment_id
     * @return mixed
     */
    public function actionView($storage_id, $equipment_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($storage_id, $equipment_id),
        ]);
    }

    /**
     * Creates a new StorageConsist model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new StorageConsist();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'storage_id' => $model->storage_id, 'equipment_id' => $model->equipment_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing StorageConsist model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $storage_id
     * @param integer $equipment_id
     * @return mixed
     */
    public function actionUpdate($storage_id, $equipment_id)
    {
        $model = $this->findModel($storage_id, $equipment_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'storage_id' => $model->storage_id, 'equipment_id' => $model->equipment_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing StorageConsist model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $storage_id
     * @param integer $equipment_id
     * @return mixed
     */
    public function actionDelete($storage_id, $equipment_id)
    {
        $this->findModel($storage_id, $equipment_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the StorageConsist model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $storage_id
     * @param integer $equipment_id
     * @return StorageConsist the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($storage_id, $equipment_id)
    {
        if (($model = StorageConsist::findOne(['storage_id' => $storage_id, 'equipment_id' => $equipment_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
