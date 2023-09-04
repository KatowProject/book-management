<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class UserTable extends Migration
{
    public function up()
    {
        $forge = $this->forge;

        $forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'unique' => true
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'role' => [
                'type' => 'INT',
                'constraint' => 1,
                'default' => 2
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'default' => new RawSql('GETDATE()')
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'default' => new RawSql('GETDATE()')
            ]
        ]);

        $forge->addKey('id', true);
        $forge->createTable('users', true);
    }

    public function down()
    {
        //
    }
}
