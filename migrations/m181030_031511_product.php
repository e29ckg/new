<?php

use yii\db\Migration;

/**
 * Class m181030_031511_product
 */
class m181030_031511_product extends Migration
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
 
        $this->createTable('product', [
            'id' => $this->primaryKey(),
            'product_name' => $this->string()->notNull()->unique(),
            'code' => $this->string(),
            'img' => $this->string(),
            'category' => $this->integer(),
            'unit' => $this->integer(),
            'Description' => $this->string(),
            'location'=> $this->string(),
            'status' => $this->smallInteger(),
            'instoke' => $this->integer(),
            'lower' => $this->integer(),
            'create_at' => $this->dateTime(),
        ], $tableOptions);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181030_031511_product cannot be reverted.\n";
        $this->dropTable('product');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181030_031511_product cannot be reverted.\n";

        return false;
    }
    */
}
