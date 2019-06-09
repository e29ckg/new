<?php

use yii\db\Migration;

/**
 * Class m181030_071221_product_unit
 */
class m181030_071221_product_unit extends Migration
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
 
        $this->createTable('product_unit', [
            'id' => $this->primaryKey(),
            'name_unit' => $this->string()->notNull()->unique(),
            'detail_unit' => $this->string(),
        ], $tableOptions);

        $this->insert('product_unit', ['name_unit' => 'รีม']);
        $this->insert('product_unit', ['name_unit' => 'ใบ']);
        $this->insert('product_unit', ['name_unit' => 'กล่อง']);
        $this->insert('product_unit', ['name_unit' => 'อัน']);
        $this->insert('product_unit', ['name_unit' => 'ม้วน']);
        $this->insert('product_unit', ['name_unit' => 'ซอง']);
        $this->insert('product_unit', ['name_unit' => 'แท่ง']);
        $this->insert('product_unit', ['name_unit' => 'ตลับ']);
        $this->insert('product_unit', ['name_unit' => 'ผืน']);
        $this->insert('product_unit', ['name_unit' => 'ด้าม']);
        $this->insert('product_unit', ['name_unit' => 'คู่']);
        $this->insert('product_unit', ['name_unit' => 'แฟ้ม']);
        $this->insert('product_unit', ['name_unit' => 'เล่ม']);
        $this->insert('product_unit', ['name_unit' => 'ขวด']);
        $this->insert('product_unit', ['name_unit' => 'ก้อน']);
        $this->insert('product_unit', ['name_unit' => 'ไม้']);
        $this->insert('product_unit', ['name_unit' => 'แผ่น']);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181030_071221_product_unit cannot be reverted.\n";
        $this->dropTable('product_unit');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181030_071221_product_unit cannot be reverted.\n";

        return false;
    }
    */
}
