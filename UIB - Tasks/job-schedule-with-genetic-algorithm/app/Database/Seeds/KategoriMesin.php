<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KategoriMesin extends Seeder
{
    public function run()
    { // membuat data
        $data = [
            [
                'nama' => 'Guillotine'
            ],
            [
                'nama' => 'Diecut'
            ],
            [
                'nama' => 'Lem'
            ],
            [
                'nama' => 'Punch Hole'
            ],
        ];

        foreach ($data as $d) {
            // insert semua d ke tabel
            $this->db->table('kategori_mesin')->insert($d);
        }

        // INSERT INTO `mesin` (`nama`, `kategori_mesin_id`, `kapasitas`) VALUES
        // ('Machine D/C I', 2, 2500),
        // ('Machine D/C II', 2, 2500),
        // ('Machine D/C III', 2, 1000),
        // ('Machine D/C V', 2, 2500),
        // ('Machine Guillotine', 1, 3600),
        // ('Machine Glue I', 3, 2000),
        // ('Machine Glue II', 3, 2000),
        // ('Machine Glue III', 3, 2000),
        // ('Machine Pelubang I', 4, 1500),
        // ('Machine Pelubang II', 4, 1500);

    }
}
