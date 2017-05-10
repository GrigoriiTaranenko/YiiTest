
<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\BookType */

$this->title = 'Create Book Type';
$this->params['breadcrumbs'][] = ['label' => 'Book Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>