<?php

use yii\db\Migration;

/**
 * Handles the creation of table `sess_device`.
 */
class m171024_164713_create_sess_device_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('sess_device', [
            'id' => $this->primaryKey(),
            'id_user' => $this->integer(),
            'token' => $this->string(),
            'start_date' => $this->integer(),
            'end_date' => $this->integer(),
            'type' => $this->integer()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('sess_device');
    }
}
