<?php

use yii\db\Migration;

/**
 * Class m181121_152337_receipt
 */
class m181121_152337_receipt extends Migration
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
        $this->createTable('receipt', [
            'id' => $this->primaryKey(),
            'receipt_code' => $this->string(32)->notNull(),
            'user_id' => $this->integer(),
            'receipt_from' => $this->string(),
            'sumtotal'=> $this->string(),
            'status' => $this->integer(),
            'create_at' => $this->dateTime(),
        ], $tableOptions);

        // $this->insert('receipt', [            
        //     'receipt_code' => 'R1234567890',
        //     'user_id' => 1,
        //     'receipt_from' => 'receipt_from',
        //     'sumtotal'=> 300,
        //     'status' => 1,
        //     'create_at' => date("Y-m-d H:i:s"),
        // ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181121_152337_receipt cannot be reverted.\n";
        $this->dropTable('receipt');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181121_152337_receipt cannot be reverted.\n";

        return false;
    }
    */
}
