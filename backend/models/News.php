<?php
namespace backend\models;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
class News extends \common\models\News {
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            BlameableBehavior::className(),
        ]; 
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'หัวข้อ',
            'date_time' => 'Date Time',
            'place' => 'Place',
            'detail' => 'Detail',
            'category_id' => 'Category ID',
            'photo' => 'Photo',
            'video' => 'Video',
        ];
    }
}