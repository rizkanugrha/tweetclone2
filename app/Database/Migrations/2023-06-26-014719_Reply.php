<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

use CodeIgniter\Database\RawSql;

class Reply extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id',
            'komens_id' => [
                'type' => 'INT',
                'constraint' => '14',
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => '5',
            ],
            'replies' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP')
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('reply', true);
    }

    public function down()
    {
        $this->forge->dropTable('reply', true);

    }
}
