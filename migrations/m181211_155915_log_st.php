<?php

use yii\db\Migration;

/**
 * Class m181211_155915_log_st
 */
class m181211_155915_log_st extends Migration
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
        $this->createTable('log_st', [
            'id' => $this->primaryKey(),
            'code' => $this->string(32)->notNull(),
            'product_code' => $this->string(32),
            'receipt_list_id' => $this->string(32),
            'unit_price' => $this->string(),
            'quantity' => $this->integer(),
            'note' => $this->string(),
            'create_at' => $this->dateTime(),
        ], $tableOptions);        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181211_155915_log_st cannot be reverted.\n";
        $this->dropTable('log_st');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181211_155915_log_st cannot be reverted.\n";

        return false;
    }
    */
}
