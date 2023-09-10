<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KategoriPekerjaan extends Seeder
{
    public function run()
    { // membuat data
        $data = [
            [
                'nama' => 'Paper Bag'
            ],
            [
                'nama' => 'Card Box'
            ],
        ];

        foreach ($data as $d) {
            // insert semua d ke tabel
            $this->db->table('kategori_pekerjaan')->insert($d);
        }
    }
}
