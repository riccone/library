<?php

namespace frontend\controllers;

use frontend\models\Maqol;
use frontend\models\BooksTags;
use frontend\models\CategoryBooks;
use frontend\models\Tags;
use Yii;
use frontend\models\Books;
use frontend\models\BooksSearch;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
        $categories = CategoryBooks::getAll();
        $data = self::getAllBooks(12);
        $best = self::getBestBooks(3);
        $maqollar = Maqol::getAll();

//        echo(Yii::getAlias('@frontend').'/web/uploads/images/');die();

        return $this->render('index', [
            'books' => $data['books'],
            'pages' => $data['pages'],
            'categories' => $categories,
            'maqollar' => $maqollar,
            'best' => $best,
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
        $books = self::getBooksByCategory(4);
        $model = Books::findOne($id);


        //session_start();
        $key = 'book'.$id;
        if (!isset($_SESSION[$key])) {
            $vd = $model->viewed;
            $model->viewed = $vd + 1;
            $model->save();
        }



        return $this->render('view', [
            'books' => $books,
            'book' => $this->findModel($id),
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
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

    /**
     *
     *
     * @return mixed
     */
    public function actionCategory($id)
    {
        $category = CategoryBooks::findOne($id);
        $data = self::getAllBooksByCategory($id, 12);
        $best = self::getBestBooks(3);

        return $this->render('category', [
            'books' => $data['books'],
            'pages' => $data['pages'],
            'category' => $category,
            'best' => $best,
        ]);
    }

    /**
     *
     *
     * @return mixed
     */
    public function actionTags($id)
    {
        $tag = Tags::findOne($id);
        $data = self::getAllBooksByTags($id, 12);
        $best = self::getBestBooks(3);

        return $this->render('tags', [
            'books' => $data['books'],
            'pages' => $data['pages'],
            'tag' => $tag,
            'best' => $best,
        ]);
    }


    public static function getAllBooks($pageSize = 12){
        $query = Books::find()->where(['status' => 1])->orderBy(['date_added' => SORT_DESC]);;
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => $pageSize]);
        $books = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        $data['pages'] = $pages;
        $data['books'] = $books;
        return $data;
    }

    public static function getBestBooks($count){
        $books = Books::find()->where(['status' => 1])->orderBy(['viewed' => SORT_DESC])->limit($count)->all();
        return $books;
    }

    public static function getAllBooksByCategory($id, $pageSize = 12){
        $query = Books::find()->where(['status' => 1])->andWhere(['category_id' => $id]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => $pageSize]);
        $books = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        $data['pages'] = $pages;
        $data['books'] = $books;
        //var_dump($books);die;
        return $data;
    }

    public static function getBooksByCategory($id){
        $books = Books::find()->where(['status' => 1])->andWhere(['category_id' => $id])->all();
        return $books;
    }

    public static function getAllBooksByTags($id, $pageSize = 12){
        $tag = Tags::findOne($id);
        //$query = Books::find()->where(['status' => 1]);//->andWhere(['tag_id' => $id]);
        $query = $tag->getBooks();
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => $pageSize]);
        $books = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        $data['pages'] = $pages;
        $data['books'] = $books;
        return $data;
    }
}
