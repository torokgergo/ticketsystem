<?php

use yii\db\Migration;

/**
 * Class m180501_131807_create_user_ticket_message_tables
 */
class m180501_131807_create_user_ticket_message_tables extends Migration
{
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'email' => $this->string()->notNull(),
            'password' => $this->string()->notNull(),
            'role' => $this->integer()->notNull()->defaultValue(0),
            'registration_date' => $this->timestamp()->defaultExpression("NOW()"),
            'last_login_date' => $this->timestamp()->defaultExpression("NOW()"),
        ]);

        $this->createTable('ticket', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'content' => $this->text()->notNull(),
            'priority' => $this->string()->notNull(),
            'status' => $this->string()->notNull(),
            'creator_id' => $this->integer()->notNull(),
            'admin_id' => $this->integer(),
            'creation_date' => $this->timestamp()->defaultExpression("NOW()"),
            'last_modified' => $this->timestamp()->defaultExpression("NOW()"),
        ]);

        $this->createTable('message', [
            'id' => $this->primaryKey(),
            'author_id' => $this->integer()->notNull(),
            'ticket_id' => $this->integer()->notNull(),
            'content' => $this->text(),
            'creation_date' => $this->timestamp()->defaultExpression("NOW()"),
        ]);

        $this->addForeignKey('ticket_creator_id',
            'ticket',
            'creator_id',
            'user',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey('ticket_admin_id',
            'ticket',
            'admin_id',
            'user',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey('message_author_id',
            'message',
            'author_id',
            'user',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey('message_ticket_id',
            'message',
            'ticket_id',
            'ticket',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey('message_ticket_id', 'message');
        $this->dropForeignKey('message_author_id', 'message');

        $this->dropForeignKey('ticket_admin_id', 'ticket');
        $this->dropForeignKey('ticket_creator_id', 'ticket');

        $this->dropTable('message');
        $this->dropTable('ticket');
        $this->dropTable('user');
    }
}
