<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Createusers extends Migration
{
    public function up()
    {
        $this->forge->addField([
                'id',
                'username' => [
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                    'unique' => true,
                ],
                'password' => [
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                ],
                'fullname' => [
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                ],
            ]);
            $this->forge->addKey('id', true);
            $this->forge->createTable('users', true);
    }

    public function down()
    {
        //buat$abel
        $this->forge->dropTable('users', true);
    }
}
