<?php

use yii\db\Migration;

/**
 * Class m181102_122933_order
 */
class m181102_122933_order extends Migration
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
        $this->createTable('order', [
            'id' => $this->primaryKey(),
            'order_code' => $this->string(32)->notNull(),
            'id_user' =>$this->integer(),
            'sumtotal'=> $this->string(),
            'status' => $this->integer(),
            'create_at' => $this->dateTime(),
        ], $tableOptions);

        // $this->insert('order', [
        //     'order_code' => 'A1234567890',
        //     'id_user' => 1,            
        //     'sumtotal'=> 2.01,
        //     'status' => 1,           
        //     'create_at' => date("Y-m-d H:i:s"),
        // ]);
    
    }
    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181102_122933_order cannot be reverted.\n";
        $this->dropTable('order');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181102_122933_order cannot be reverted.\n";

        return false;
    }
    */
}
