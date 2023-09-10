<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Users extends Seeder
{
    public function run()
    { // membuat data
        $data = [
            [
                'username' => 'admin',
                'password' => 'admin',
            ],
        ];

        foreach ($data as $d) {
            // insert semua d ke tabel
            $this->db->table('users')->insert($d);
        }
    }
}
