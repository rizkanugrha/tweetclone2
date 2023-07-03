<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

use CodeIgniter\Database\RawSql;

class Komens extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id',
            'komentar' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => '5',
            ],
            'tweet_id' => [
                'type' => 'INT',
                'constraint' => '9',
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP')
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP')
            ],
        ]);
        $this->forge->addPrimaryKey('id', 'komens_id');
        $this->forge->createTable('komens', true);
    }

    public function down()
    {
        $this->forge->dropTable('komens', true);

    }
}