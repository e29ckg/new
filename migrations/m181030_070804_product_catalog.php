<?php

use yii\db\Migration;

/**
 * Class m181030_070804_product_catalog
 */
class m181030_070804_product_catalog extends Migration
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
 
        $this->createTable('product_catalog', [
            'id' => $this->primaryKey(),
            'name_catalog' => $this->string()->notNull()->unique(),
            'order' => $this->integer(),
            'detail_catalog' => $this->string(),
        ], $tableOptions);

        $this->insert('product_catalog', ['name_catalog' => 'วัสดุสำนักงาน','order' => 1,'detail_catalog' => '']);
        $this->insert('product_catalog', ['name_catalog' => 'วัสดุคอมพิวเตอร์','order' => 2,'detail_catalog' => '']);
        $this->insert('product_catalog', ['name_catalog' => 'วัสดุไฟฟ้า','order' => 3,'detail_catalog' => '']);
        $this->insert('product_catalog', ['name_catalog' => 'วัสดุงานบ้านงานครัว','order' => 4,'detail_catalog' => '']);
    
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181030_070804_product_catalog cannot be reverted.\n";
        $this->dropTable('product_catalog');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181030_070804_product_catalog cannot be reverted.\n";

        return false;
    }
    */
}
