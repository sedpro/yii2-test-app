<?php
/** @var app\models\Book $book */
?>

<div class="modal-header">
    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
    <h2><?php echo $book->name;?></h2>
</div>
<div class="modal-body">
    <?php if ($book->preview):?>
        <div>
            <?php echo yii\helpers\Html::img($book->previewurl, ['width' => '300px']);?>
        </div>
    <?php endif;?>

    <div>
        Автор: <?php echo $book->authorname;?>
    </div>

    <div>
        Дата выхода книги: <?php echo $book->date;?>
    </div>

    <div>
        Дата добавления: <?php echo $book->date_create;?>
    </div>

    <div>
        Дата изменения: <?php echo $book->date_update;?>
    </div>
</div>
