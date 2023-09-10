<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KategoriMesin extends Migration
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
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('kategori_mesin');
    }

    public function down()
    {
        $this->forge->dropTable('kategori_mesin');
    }
}
