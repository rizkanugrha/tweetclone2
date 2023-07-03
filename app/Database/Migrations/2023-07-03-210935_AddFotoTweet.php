<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFotoTweet extends Migration
{
    public function up()
    {
        $this->forge->addColumn('tweets', [
            'fototweet' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
        ]);
    }

    public function down()
    {
       $this->forge->dropColumn('tweets', 'fototweet');
    }
}
