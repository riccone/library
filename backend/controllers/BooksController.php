<?php

namespace backend\controllers;

use backend\models\CategoryBooks;
use backend\models\DocUpload;
use backend\models\ImageUpload;
use backend\models\Tags;
use Yii;
use backend\models\Books;
use backend\models\BooksSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * BooksController implements the CRUD actions for Books model.
 */
class BooksController extends Controller
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
     * Lists all Books models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BooksSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Books model.
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
     * Creates a new Books model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Books();
        $model->viewed = 0;

        $unique = strtolower(md5(rand(10000,99999)));
        $model->book_key = 'boo'.$unique;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $tags = Yii::$app->request->post('tags');
            if (!empty($tags)){

                $model->saveTags($tags);
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Books model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $tags = Yii::$app->request->post('tags');
            if (!empty($tags)){
                $model->saveTags($tags);
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Books model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Books model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Books the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Books::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionSetImage($id){

    $model = new ImageUpload();

    if(Yii::$app->request->isPost){

        $book = $this->findModel($id);
        $file = UploadedFile::getInstance($model, 'image');

//            $book->saveImage($model->uploadFile($file, $book->image));
        if ($book->saveImage($model->uploadFile($file, $book->image))){
            return $this->redirect(['view', 'id' => $book->id]);
        }
    }

    return $this->render('image', ['model' => $model]);
}

    public function actionSetDocument($id){
        $model = new DocUpload();

        if(Yii::$app->request->isPost){

            $book = $this->findModel($id);
            $file = UploadedFile::getInstance($model, 'document');

            if ($book->saveDoc($model->uploadFile($file, $book->document))){
                return $this->redirect(['view', 'id' => $book->id]);
            }
        }

        return $this->render('document', ['model' => $model]);
    }

    public function actionPublish($id){
        $book = $this->findModel($id);
        if (empty($book->image) || empty($book->document)){
            Yii::$app->session->setFlash('error', "Перед публикацией установите обложку и документ PDF");
            return $this->redirect(['view', 'id' => $book->id]);
        }
        if(!empty($book->image) && !empty($book->document)){
            $book->status = 1;
            if($book->save(false)){
                return $this->redirect(['view', 'id' => $book->id]);
            } else{
                die('xatolik');
            }
        }

    }

    public function actionUnpublish($id){
        $book = $this->findModel($id);
        //var_dump($book->name);die();
        $book->status = 0;
        if($book->save(false)){
            return $this->redirect(['view', 'id' => $book->id]);
        } else{
            die('xatolik');
        }
    }

    public function actionCategory($id){
        $book = $this->findModel($id);
//        var_dump($book->category->name);
    }

    public function actionSetTags($id){
        $book = $this->findModel($id);
        $selectedTags = $book->getSelectedTags();
        $tags = ArrayHelper::map(Tags::find()->all(), 'id','name');

        if (Yii::$app->request->isPost){
            $tags = Yii::$app->request->post('tags');
            $book->saveTags($tags);
            return $this->redirect(['view', 'id' => $book->id]);
        }

        return $this->render('tags', [
            'selectedTags' => $selectedTags,
            'tags' => $tags
        ]);
    }
}
