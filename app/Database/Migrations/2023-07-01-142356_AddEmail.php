<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddEmail extends Migration
{
    public function up()
    {
       $this->forge->addColumn('users', [
        'email' => [
            'type' => 'VARCHAR',
            'constraint' => '150',
        ],
       ]);
    }

    public function down()
    {
        $this->forge->dropColumn('users', 'email');
    }
}
