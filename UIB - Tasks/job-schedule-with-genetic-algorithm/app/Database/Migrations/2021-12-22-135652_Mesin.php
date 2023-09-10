<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Mesin extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'auto_increment' => true,
            ],
            'nama'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'kategori_mesin_id'       => [
                'type'       => 'INT',
            ],
            'kapasitas'       => [
                'type'       => 'INT',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('kategori_mesin_id', 'kategori_mesin', 'id');
        $this->forge->createTable('mesin');
    }

    public function down()
    {
        $this->forge->dropTable('mesin');
    }
}
