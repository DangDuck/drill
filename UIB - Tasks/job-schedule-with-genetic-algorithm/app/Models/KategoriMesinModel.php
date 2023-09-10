<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriMesinModel extends Model
{
  protected $table      = 'kategori_mesin';
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
