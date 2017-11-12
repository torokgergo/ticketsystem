<?php

use yii\db\Migration;

class m170927_173555_init_tables extends Migration
{
    public function safeUp()
    {
        $this->createTable("user",[
            "id" => $this->primaryKey(),
            "email" => $this->string()->notNull(),
            "password" => $this->text()->notNull(),
            "name" => $this->string()->notNull(),
            "room" => $this->integer()->notNull(),
            "permission" => $this->smallInteger(),
            "is_confirmed" => $this->boolean()->defaultValue(false),
            "reg_date" => $this->timestamp()->defaultExpression("NOW()"),
        ]);

        $this->createTable("event",[
            "id" => $this->primaryKey(),
            "event_name" => $this->string()->notNull(),
            "description" => $this->text(),
            "event_date" => $this->dateTime(),
        ]);

        $this->createTable("event_apply",[
            "user_id" => $this->integer(),
            "event_id" => $this->integer(),
            "is_paid" => $this->boolean()->defaultValue(false),
        ]);

        $this->addForeignKey("event_apply_userid_fk","event_apply","user_id","user","id","NO ACTION","NO ACTION");
        $this->addForeignKey("event_apply_eventid_fk","event_apply","event_id","event","id","NO ACTION","NO ACTION");
    }

    public function safeDown()
    {
        $this->dropForeignKey("event_apply_userid_fk","event_apply");
        $this->dropForeignKey("event_apply_eventid_fk","event_apply");

        $this->dropTable("event_apply");
        $this->dropTable("event");
        $this->dropTable("user");
    }
}
