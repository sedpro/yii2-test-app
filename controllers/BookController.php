<?php

namespace app\controllers;

use app\filters\AjaxAccess;
use app\models\BookUpdateForm;
use app\models\BookSearchForm;
use app\models\BookSearch;
use app\models\Book;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\UploadedFile;

class BookController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only'  => ['index', 'update', 'modal', 'delete'],
                'rules' => [
                    [
                        'allow'   => true,
                        'roles'   => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => \yii\filters\VerbFilter::class,
                'actions' => [
                    'modal' => ['get'],
                    'delete' => ['get'],
                ],
            ],
            'ajax' => [
                'class' => AjaxAccess::class,
                'only'  => ['modal', 'delete'],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => \yii\web\ErrorAction::class,
        ];
    }

    public function actionIndex()
    {
        $get = Yii::$app->request->get();

        $formModel = new BookSearchForm();
        $formModel->load(Yii::$app->request->get());

        $searchModel = new BookSearch();

        // dirty hack to use form instead of built-in gridView filter
        if (isset($get[$formModel->formName()])) {
            $get[$searchModel->formName()] = $get[$formModel->formName()];
        }

        $dataProvider = $searchModel->search($get);

        Yii::$app->getUser()->setReturnUrl(Yii::$app->request->getUrl());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'formModel' => $formModel,
        ]);
    }

    public function actionUpdate()
    {
        $id = (int)Yii::$app->request->get('id');

        if ($id) {
            /** @var Book $book */
            $book = Book::findOne(['id' => $id]);
            if ($book) {
                $bookUpdateForm = new BookUpdateForm();
                $bookUpdateForm->fill($book);

                if ($bookUpdateForm->load(Yii::$app->request->post())) {
                    $bookUpdateForm->imageFile = UploadedFile::getInstance($bookUpdateForm, 'imageFile');

                    if ($bookUpdateForm->update($book)) {
                        return $this->goBack();
                    }
                }
                return $this->render('update', [
                    'bookUpdateForm' => $bookUpdateForm
                ]);
            }
        }

        return $this->goBack();
    }

    public function actionModal()
    {
        $id = (int)Yii::$app->request->get('id');
        $book = Book::findOne(['id' => $id]);

        return $this->renderAjax('modal', [
            'book' => $book,
        ]);
    }

    public function actionDelete()
    {
        $id = (int)Yii::$app->request->get('id');

        /** @var Book $book */
        $book = Book::findOne(['id' => $id]);
        $result = $book
            ? $book->delete()
            : false;

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return ['result' => (bool)$result];
    }
}