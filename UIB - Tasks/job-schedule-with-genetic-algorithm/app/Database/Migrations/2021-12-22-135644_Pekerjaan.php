<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pekerjaan extends Migration
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
            'kategori_pekerjaan_id'       => [
                'type'       => 'INT',
            ],
            'kuantitas'       => [
                'type'       => 'INT',
            ],
            'jatuh_tempo'       => [
                'type'       => 'DATE',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('kategori_pekerjaan_id', 'kategori_pekerjaan', 'id');
        $this->forge->createTable('pekerjaan');
    }

    public function down()
    {
        $this->forge->dropTable('pekerjaan');
    }
}
