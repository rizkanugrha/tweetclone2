<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
class AddFoto extends Migration
{
    public function up()
{
    $this->forge->addColumn('users', [
        'fotoprofil' => [
            'type'       => 'VARCHAR',
            'constraint' => '255',
        ],
    ]);
}

    public function down()
    {
        $this->forge->dropColumn('users', 'fotoprofil');
    }
}
