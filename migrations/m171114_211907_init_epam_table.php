<?php

use yii\db\Migration;

class m171114_211907_init_epam_table extends Migration
{
    public function safeUp()
    {
        $this->dropColumn('user','room');
        $this->dropColumn('user','permission');
        $this->dropColumn('user','is_confirmed');

        $this->dropForeignKey("event_apply_userid_fk","event_apply");
        $this->dropForeignKey("event_apply_eventid_fk","event_apply");

        $this->dropTable('event');
        $this->dropTable('event_apply');

        $this->createTable('page',[
           'id' => $this->primaryKey(),
            'title' => $this->string(),
            'content' => $this->text(),
            'create_date' => $this->timestamp()->defaultExpression("NOW()"),
            'user_id' => $this->integer(),
        ]);

        $this->addForeignKey('fk_page_user_id_user_id', 'page', 'user_id', 'user', 'id');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_page_user_id_user_id', 'page');

        $this->dropTable('page');

        $this->createTable("event_apply",[
            "user_id" => $this->integer(),
            "event_id" => $this->integer(),
            "is_paid" => $this->boolean()->defaultValue(false),
        ]);

        $this->createTable("event",[
            "id" => $this->primaryKey(),
            "event_name" => $this->string()->notNull(),
            "description" => $this->text(),
            "event_date" => $this->dateTime(),
        ]);

        $this->addForeignKey("event_apply_userid_fk","event_apply","user_id","user","id","NO ACTION","NO ACTION");
        $this->addForeignKey("event_apply_eventid_fk","event_apply","event_id","event","id","NO ACTION","NO ACTION");

        $this->addColumn('user','room',$this->integer()->notNull());
        $this->addColumn('user','permission',$this->smallInteger());
        $this->addColumn('user','is_confirmed',$this->boolean()->defaultValue(false));

    }

}
