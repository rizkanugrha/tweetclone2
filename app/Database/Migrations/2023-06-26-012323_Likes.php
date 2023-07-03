<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Likes extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id',
            'user_id' => [
                'type' => 'INT',
                'constraint' => '5',
            ],
            'tweet_id' => [
                'type' => 'INT',
                'constraint' => '9',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('likes', true);
    }

    public function down()
    {
        $this->forge->dropTable('likes', true);
    }
}
