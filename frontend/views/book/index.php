
<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\components\Hello;
//use frontend\assets\AppAsset;
use yii\helpers\Json;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Книга';
$this->params['breadcrumbs'][] = $this->title;
?>
<p>Hello world</p>
<div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить книгу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'year',
            [
                'attribute' => 'type',
                'filter' => Html::activeDropDownList($searchModel, 'type',$searchModel->mapType),
            ],
            'isbn',
           /* 'description',
            [
                'attribute' => 'picture',
                'format' => 'image',
            ],*/
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php
 //       $bundle = AppAsset::register($this);
 //       echo(Html::img($bundle->sourcePath.'/Book.jpg'));

    ?>
</div>