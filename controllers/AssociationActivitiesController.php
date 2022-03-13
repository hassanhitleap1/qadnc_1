<?php

namespace app\controllers;

use app\models\associationactivities\AssociationActivities;
use app\models\associationactivities\AssociationActivitiesSearch;
use app\models\User;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
use yii\web\UploadedFile;

/**
 * AssociationActivitiesController implements the CRUD actions for AssociationActivities model.
 */
class AssociationActivitiesController extends Controller
{

    public function init()
    {
        $this->layout = "admin";
        parent::init();
        if (\Yii::$app->user->isGuest) {
            header("Location: https://qadnc.org.sa/web/site/login");
            exit();
        }elseif (Yii::$app->user->identity->type != User::SUPER_ADMIN) {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    
    }

    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all AssociationActivities models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AssociationActivitiesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AssociationActivities model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AssociationActivities model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new AssociationActivities();


        if ($this->request->isPost) {
            $newId = AssociationActivities::find()->max('id') + 1;
            if ($model->load($this->request->post()) ) {
                $model->file = UploadedFile::getInstance($model, 'file');
                if($model->validate()){
                    if (!is_null( $model->file)) {
                        FileHelper::createDirectory("uploads/associationactivities/$newId");
                        $path="uploads/associationactivities/$newId/index" . "." .  $model->file->extension;
                        $model->file->saveAs($path);
                        $model->image=$path;
                    }
                    $model->save(false);
                    return $this->redirect(['view', 'id' => $model->id]);
                }


            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing AssociationActivities model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) ) {
            if($model->validate()){
                $model->file = UploadedFile::getInstance($model, 'file');
                if (!is_null( $model->file)) {
                    FileHelper::createDirectory("uploads/associationactivities/$model->id");
                    $path="uploads/associationactivities/$model->id/index" . "." .  $model->file->extension;
                    $model->file->saveAs($path);
                    $model->image=$path;
                }
                $model->save(false);
                return $this->redirect(['view', 'id' => $model->id]);
            }

        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AssociationActivities model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AssociationActivities model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return AssociationActivities the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AssociationActivities::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
