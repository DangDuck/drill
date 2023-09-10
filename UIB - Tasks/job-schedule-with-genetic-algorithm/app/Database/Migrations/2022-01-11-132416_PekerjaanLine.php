<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PekerjaanLine extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                 => [
                'type'           => 'INT',
                'auto_increment' => true,
            ],
            'pekerjaan_id'      => [
                'type'          => 'INT',
            ],
            'urutan'            => [
                'type'          => 'INT',
            ],
            'proses_id'            => [
                'type'          => 'INT',
            ],
            'kategori_mesin_id' => [
                'type'          => 'INT',
            ],
            'mesin_id'          => [
                'type'          => 'INT',
            ],
            'waktu'             => [
                'type'          => 'INT',
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('pekerjaan_id', 'pekerjaan', 'id');
        $this->forge->addForeignKey('proses_id', 'proses_pekerjaan', 'id');
        $this->forge->addForeignKey('kategori_mesin_id', 'kategori_mesin', 'id');
        $this->forge->addForeignKey('mesin_id', 'mesin', 'id');
        $this->forge->createTable('pekerjaan_line');
    }

    public function down()
    {
        $this->forge->dropTable('pekerjaan_line');
    }
}
