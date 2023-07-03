<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
class Addtoken extends Migration
{
    public function up()
{
    $this->forge->addColumn('users', [
        'token' => [
            'type'       => 'VARCHAR',
            'constraint' => '255',
        ],
    ]);
}

    public function down()
    {
        $this->forge->dropColumn('users', 'token');
    }
}
