<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Category;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model backend\models\News */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'date_time')->textInput(); ?>
    <?php
    echo '<b>'.$model->getAttributeLabel('date_time').'</b>';
    echo DatePicker::widget([
        'model' => $model,
        'attribute' => 'date_time', 
        'value' => date('Y-m-d'),
        'options' => ['placeholder' => 'Select date ...'],
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true
        ]
    ]);
    ?>

    <?= $form->field($model, 'place')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'detail')->textarea(['rows' => 6]) ?>

    <?php
    $categories = Category::find()->where(['is_active'=>1])->asArray()->all();
    $categoryList = ArrayHelper::map($categories, 'id', 'name');
    // print_r($categoryList);
    ?>
    <?= $form->field($model, 'category_id')->dropDownList($categoryList, ['prompt' => 'Select Category']) ?>


    <div class="row">
        <div class="col-sm-3">
            <?= $form->field($model, 'photo')->fileInput(['maxlength' => true]) ?>
            <?php 
            if ($model->photo) {
                $path='../../uploads/';
                echo '<img src='.$path.$model->photo.' width=100 />';
            }
            ?>
        </div>
        <div class="col-sm-9">
            <?= $form->field($model, 'video')->textInput(['maxlength' => true]) ?> 
        </div>
    </div>


    
    

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>