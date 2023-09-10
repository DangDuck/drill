<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Menu extends Seeder
{
    public function run()
    {
        // membuat data
        $data = [
            [
                'title' => 'Kategori Pekerjaan',
                'link'  => 'kategori_pekerjaan',
                'icon' => 'fas fa-table'
            ],
            [
                'title' => 'Pekerjaan',
                'link'  => 'pekerjaan',
                'icon' => 'fas fa-tasks'
            ],
            [
                'title' => 'Kategori Mesin',
                'link'  => 'kategori_mesin',
                'icon' => 'fas fa-table'
            ],
            [
                'title' => 'Mesin',
                'link'  => 'mesin',
                'icon' => 'fas fa-cash-register'
            ],
            [
                'title' => 'Proses Pekerjaan',
                'link'  => 'proses_pekerjaan',
                'icon' => 'fas fa-atom'
            ],
        ];

        /*
            atom = fas fa-atom
            cash-register = fas fa-cash-register
            tasks = fas fa-tasks
            kategori = fas fa-table
        */

        foreach ($data as $d) {
            // insert semua data ke tabel
            $this->db->table('menu')->insert($d);
        }
    }
}
