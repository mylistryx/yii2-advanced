<?php

use common\components\migrations\Migration;

class m130524_201442_init extends Migration
{
    public function safeUp(): void
    {
        $this->createTable('identity', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'verification_token' => $this->string()->defaultValue(null),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    public function safeDown(): void
    {
        $this->dropTable('identity');
    }
}
