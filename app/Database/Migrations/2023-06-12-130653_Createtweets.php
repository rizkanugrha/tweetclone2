<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Createtweets extends Migration
{
    public function up()
    {
        $this->forge->addField(
            [
                'id',
                'user_id' => [
                    'type' => 'INT',
                    'constraint' => 5,
                ],
                'content' => [
                    'type' => 'TEXT',
                ],
                'category' => [
                    'type' => 'VARCHAR',
                    'constraint' => 50,
                ],
                'created_at' => [
                    'type' => 'TIMESTAMP',
                    'default' => new RawSql('CURRENT_TIMESTAMP')
                ],
                'updated_at' => [
                    'type' => 'TIMESTAMP',
                    'default' => new RawSql('CURRENT_TIMESTAMP')
                ],
            ]
        );
        $this->forge->addPrimaryKey('id', 'tweet_id');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE', 'fk_user');
        $this->forge->createTable('tweets', true);
    }

    public function down()
    {
        $this->forge->dropTable('tweets', true);
    }
}