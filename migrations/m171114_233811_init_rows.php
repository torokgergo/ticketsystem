<?php

use yii\db\Migration;

/**
 * Class m171114_233811_init_rows
 */
class m171114_233811_init_rows extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->insert(
            'user',
            [
                'email' => 'admin@admin.com',
                'name' => 'Admin User',
                'password' => '$2y$13$vwe1JtvHdARXATgYbhc2L.bv9WPEpEqMdLwRqDtzgxsIe0JRqVFgy',
            ]
        );

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->delete('user', ['email' => 'admin@admin.com']);
    }
}
