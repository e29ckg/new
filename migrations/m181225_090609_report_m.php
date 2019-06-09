<?php

use yii\db\Migration;

/**
 * Class m181225_090609_report_m
 */
class m181225_090609_report_m extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
 
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('report_m', [
            'id' => $this->primaryKey(),
            'month' => $this->string(),
            'detail' => $this->string(),
            'create_at' => $this->dateTime(),
        ], $tableOptions); 
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181225_090609_report_m cannot be reverted.\n";
        $this->dropTable('report_m');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181225_090609_report_m cannot be reverted.\n";

        return false;
    }
    */
}
