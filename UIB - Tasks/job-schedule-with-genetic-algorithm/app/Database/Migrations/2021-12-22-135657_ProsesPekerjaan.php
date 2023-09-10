<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProsesPekerjaan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'    => [
                'type'           => 'INT',
                'auto_increment' => true,
            ],
            'nama'  => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'urutan'    => [
                'type'      => 'INT',
            ],
            'kategori_pekerjaan_id'    => [
                'type'      => 'INT',
                'null'      => true
            ],
            'kategori_mesin_id'    => [
                'type'      => 'INT',
                'null'      => true
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('kategori_pekerjaan_id', 'kategori_pekerjaan', 'id');
        $this->forge->addForeignKey('kategori_mesin_id', 'kategori_mesin', 'id');
        $this->forge->createTable('proses_pekerjaan');
    }

    public function down()
    {
        $this->forge->dropTable('proses_pekerjaan');
    }
}
