<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTokken extends Migration
{
    public function up()
{
    $this->forge->addColumn('users', [
        'token' => [
            'type'       => 'VARCHAR',
            'constraint' => '255',
        ],
        'token_expired' => [
            'type' => 'DATETIME'
        ],
    ]);
}

    public function down()
    {
        $this->forge->dropColumn('users', 'token');
        $this->forge->dropColumn('users', 'token_expired');
    }
}
