<?php

use yii\db\Migration;

class m171001_175339_add_pk_to_apply extends Migration
{
    public function safeUp()
    {
        $this->addColumn("event_apply","id",$this->primaryKey());
    }

    public function safeDown()
    {
        $this->dropColumn("event_apply","id");
    }

}
