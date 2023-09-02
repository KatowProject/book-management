<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class BookTable extends Migration
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
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'author' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'publisher' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'year' => [
                'type' => 'INT',
                'constraint' => 4
            ],
            'total_page' => [
                'type' => 'INT',
                'constraint' => 4
            ],
            'price' => [
                'type' => 'INT',
                'constraint' => 10
            ],
            'image' => [
                'type' => 'TEXT',
                'default' => 'default.jpg'
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'default' => new RawSql('GETDATE()')
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'default' => new RawSql('GETDATE()')
            ],
        ]);
        $forge->addKey('id', true);
        $forge->createTable('books', true);
    }

    public function down()
    {
        //
    }
}