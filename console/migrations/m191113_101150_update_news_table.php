<?php

use yii\db\Migration;

/**
 * Class m191113_101150_update_news_table
 */
class m191113_101150_update_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('news','date_time',$this->string());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191113_101150_update_news_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191113_101150_update_news_table cannot be reverted.\n";

        return false;
    }
    */
}
