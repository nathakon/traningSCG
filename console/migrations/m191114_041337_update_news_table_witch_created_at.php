<?php

use yii\db\Migration;

/**
 * Class m191114_041337_update_news_table_witch_created_at
 */
class m191114_041337_update_news_table_witch_created_at extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('news','created_at',$this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191114_041337_update_news_table_witch_created_at cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191114_041337_update_news_table_witch_created_at cannot be reverted.\n";

        return false;
    }
    */
}
