<?php

/* @var $this \yii\web\View */
use yii\grid\GridView;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use app\widgets\Lightbox;

$this->title = 'Книги';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile('/js/book.js', ['depends' => 'yii\web\JqueryAsset']);

?>

<h1><?php echo Html::encode($this->title) ?></h1>

    <div>

        <?php $form = ActiveForm::begin(['method' => 'get']); ?>

        <?php echo $form->field($formModel, 'name') ?>

        <?php echo $form->field($formModel, 'authorName')->dropDownList(\app\models\Author::getDropdownList()); ?>

        <?php echo $form->field($formModel, 'dateFrom')->widget('yii\jui\DatePicker',[
            'language' => 'ru',
            'dateFormat' => 'yyyy-MM-dd',
            'options' => ['class' => 'form-control',],
        ]); ?>

        <?php echo $form->field($formModel, 'dateTo')->widget('yii\jui\DatePicker',[
            'language' => 'ru',
            'dateFormat' => 'yyyy-MM-dd',
            'options' => ['class' => 'form-control',],
        ]); ?>

        <div class="form-group">
            <?= Html::submitButton('Искать', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

<?php echo GridView::widget([
    'dataProvider' => $dataProvider,
    'layout' => '{items}{pager}',
    'columns' => [
        'id',
        'name',
        [
            'attribute' => 'preview',
            'headerOptions' => ['width' => '100'],
            'format' => 'raw',
            'value' => function ($data) {
                return $data->preview ? Lightbox::widget(['url' => $data->previewurl]) : '';
            },
        ],
        'authorName',
        'date:date',
        'date_create:date',
        [
            'class' => \yii\grid\ActionColumn::class,
            'header'=>'Действия',
            'headerOptions' => ['width' => '250'],
            'template' => '{update} {view} {delete}',
            'buttons' => [
                'update' => function ($url, $model) {
                    return Html::a('Редактировать',$url);
                },
                'delete' => function ($url, $model) {
                    return Html::a('Удалить',$url, ['class' => 'book-delete']);
                },
                'view' => function ($url, $model) {
                    return Html::a('Просмотр', ['/book/modal', 'id' => $model->id], [
                        'title' => 'Просмотр',
                        'data' => [
                            'target' => '#myModal',
                            'toggle' => 'modal',
                            'backdrop' => 'static',
                        ]
                    ]);
                },
            ],
        ],
    ],
]);

Modal::begin([
    'clientOptions' => false,
    'options' => [
        'remote' => '/book/modal?id=1',
        'id' => 'myModal',
    ],
]);
Modal::end();