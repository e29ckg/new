<?php

use yii\db\Migration;

/**
 * Class m181225_090619_report_m_l
 */
class m181225_090619_report_m_l extends Migration
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
        $this->createTable('report_m_l', [
            'id' => $this->primaryKey(),
            'month' => $this->string(),
            'product_code' => $this->string(),
            'product_unit' => $this->string(),
            'kb' => $this->integer(),
            'r' => $this->integer(),
            'o' => $this->integer(),
            'k' => $this->integer(),
            'unit_price' => $this->string(),
            'total_price' => $this->string(),
            'detail' => $this->string(),
            'create_at' => $this->dateTime(),
        ], $tableOptions);   
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181225_090619_report_m_l cannot be reverted.\n";
        $this->dropTable('report_m_l');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181225_090619_report_m_l cannot be reverted.\n";

        return false;
    }
    */
}
