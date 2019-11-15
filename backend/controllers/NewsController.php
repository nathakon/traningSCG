<?php
namespace backend\controllers;
use Yii;
use backend\models\News;
use backend\models\NewsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all News models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(!Yii::$app->user->can('news/index')){
            return $this->redirect(['site/login']);
        }
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Displays a single News model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
    return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    /**
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(!Yii::$app->user->can('news/create')){
            return $this->redirect(['site/login']);
        }
        $model = new News();
        if (Yii::$app->request->post()) {
            $model->load(Yii::$app->request->post());
            print_r($model->attributes);
            $file = UploadedFile::getInstance($model, 'photo');
            //echo 'auto= xyz.'.$file->getExtension().'<br/>';
            //$explode = explode('.', $file);
            //$countArr = count($explode);
            //$extension = $explode[$countArr-1];
            //$newName = date('Ymdhis').'.'.$extension;
            //echo 'manual ='.$newName;
            $newName = date('Ymdhis').'.'.$file->getExtension();
            $model->photo = $newName;
            
            $path = '../../uploads/'.$newName;
            $file->saveAs($path);
            //print_r($model->attributes);
            $model->save();
            //print_r($explode);
            //return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect(['index']);
        }
       
        
        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->id]);
        // }
        return $this->render('create', [
            'model' => $model,
        ]);
    }
    /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if(!Yii::$app->user->can('news/update')){
            return $this->redirect(['site/login']);
        }
        $model = $this->findModel($id);
        
        
        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->id]);
        // }
        if (Yii::$app->request->isPost) {
            // keep old name for delete
            
            echo '<pre>'.print_r($model->attributes, true).'</pre>';
            $xFilename = $model->photo;
            echo 'xFilename='.$xFilename;
            $model->load(Yii::$app->request->post());
            echo '<pre>'.print_r($model->attributes, true).'</pre>';
            //exit;
            // upload?
            $file = UploadedFile::getInstance($model, 'photo');
            if ($file) {
                $model->photo = date('Ymdhis').'.'.$file->getExtension();
                $path = '../../uploads/';
                if ($file->saveAs($path.$model->photo)) {
                    if ($xFilename)
                        unlink($path.$xFilename);
                }
            } else {
                $model->photo = $xFilename;
            }
            
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }
    /**
     * Deletes an existing News model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if(!Yii::$app->user->can('news/delete')){
            return $this->redirect(['site/login']);
        }
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }
    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}