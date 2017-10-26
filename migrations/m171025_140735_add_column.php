<?php

use yii\db\Migration;

class m171025_140735_add_column extends Migration
{
    public function safeUp()
    {
        $this->addColumn("sess_device", "reg_id", $this->string());
    }

    public function safeDown()
    {
        $this->dropColumn("sess_device", "reg_id");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171025_140735_add_column cannot be reverted.\n";

        return false;
    }
    */
}
