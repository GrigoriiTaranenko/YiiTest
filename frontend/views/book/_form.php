<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Book */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="raw"></div>
<div class="book-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'year')->textInput() ?>
        <div class="col-lg-10">
        <?= $form->field($model, 'id_book_type')->dropDownList($model->typeModel) ?>
        </div>
        <div class="col-lg-2">
            <br>
            <?=Html::button(   'Добавить Жанр', ['class'=>'btn btn-success'])?>
            <br>
        </div>

    <?= $form->field($model, 'isbn')->textinput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>