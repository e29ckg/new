<?php

use yii\db\Migration;

/**
 * Class m181102_123037_order_list
 */
class m181102_123037_order_list extends Migration
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
        $this->createTable('order_list', [
            'id' => $this->primaryKey(),
            'order_code' => $this->string(32)->notNull(),
            'product_code' => $this->string(),
            'receipt_list_id' => $this->string(32),
            'unit_price' => $this->string(),
            'quantity' => $this->integer(),
            'create_at' => $this->dateTime(),
        ], $tableOptions);

        // $this->insert('order_list', [
        //     'order_code' => 'A1234567890',
        //     'product_code' => 'P0987654321',
        //     'unit_price' => 100,
        //     'quantity' => 10,
        //     'create_at' => date("Y-m-d H:i:s"),
        // ]);

        // $this->insert('order_list', [
        //     'order_code' => 'A1234567890',
        //     'product_code' => 'P1234567890',
        //     'unit_price' => 100,
        //     'quantity' => 10,
        //     'create_at' => date("Y-m-d H:i:s"),
        // ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181102_123037_order_list cannot be reverted.\n";
        $this->dropTable('order_lists');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181102_123037_order_list cannot be reverted.\n";

        return false;
    }
    */
}
