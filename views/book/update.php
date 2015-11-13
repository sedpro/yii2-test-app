<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Book;

/* @var $this yii\web\View */
/* @var $bookUpdateForm app\models\BookUpdateForm */

$this->title = 'Редактирование';
$this->params['breadcrumbs'][] = ['label' => 'Книги', 'url' => ['/book/index']];
$this->params['breadcrumbs'][] = $this->title;

$js=<<<JS
$('#currentImageContainer span').on('click', function(){
    $("#bookupdateform-deleteimage").val(true);
    $("#currentImageContainer").remove();
});
JS;
$this->registerJs($js);

?>

<div class="update-book">
    <h3><?= Html::encode($this->title) ?></h3>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php echo $form->field($bookUpdateForm, 'name') ?>

    <?php echo $form->field($bookUpdateForm, 'author_id')->dropDownList(
            \app\models\Author::getDropdownList()
    ); ?>

    <?php echo $form->field($bookUpdateForm, 'date')->widget('yii\jui\DatePicker',[
        'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd',
        'options' => ['class' => 'form-control',],
    ]); ?>

    <?= $form->field($bookUpdateForm, 'imageFile')->fileInput()->label("Превью (опционально)") ?>

    <?= Html::activeHiddenInput($bookUpdateForm, 'deleteImage') ?>

    <?php if (!empty($bookUpdateForm->currentImage)): ?>
        <div class="current-image" id="currentImageContainer">
            <?= Html::label('Текущее превью', null, ['class' => 'control-label']) ?>
            <?= Html::tag('span', '', [
                'class' => 'icon glyphicon glyphicon-remove',
                'aria-hidden' => 'true',
                'aria-label' => 'Remove',
                'title' => 'Remove',
            ]); ?>
            <br>
            <?= Html::img(Book::IMAGE_FOLDER . $bookUpdateForm->currentImage, ['class' => 'book-image img-thumbnail']) ?>
            <br><br>
        </div>
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>