<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'News';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create News', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'photo',
                'content' => function($data){
                    $path='../../uploads/'.$data->photo;
                    if($data->photo){
                    return  "<img src=".$path." width=50";  
                    }else{

                    } return;
                                
                 }
            ],
            //'id',
            'title',
            'date_time',
            'place',
            'detail:ntext',
            //'category_id',
            
            //'video',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
