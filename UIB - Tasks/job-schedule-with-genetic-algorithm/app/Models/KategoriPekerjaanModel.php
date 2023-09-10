<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriPekerjaanModel extends Model
{
  protected $table      = 'kategori_pekerjaan';
  protected $allowedFields = ['nama'];

  public function get_data($id = False)
  {
    if (!$id) {
      return $this->findAll();
    } else {
      return $this->find($id);
    };
  }
}
