<?php

namespace App\Models;

use CodeIgniter\Model;

class PekerjaanModel extends Model
{
  protected $table      = 'pekerjaan';
  protected $allowedFields = ['nama', 'kategori_pekerjaan_id', 'kuantitas', 'jatuh_tempo'];

  public function get_data($id = False)
  {
    $kategoriPekerjaanModel = model('App\Models\KategoriPekerjaanModel', false);
    if (!$id) {
      $data = $this->findAll();
      for ($i = 0; $i < count($data); $i++) {
        $data[$i]['kategori_pekerjaan_id'] = $kategoriPekerjaanModel->find($data[$i]['kategori_pekerjaan_id']);
      }
      return $data;
    } else {
      return $this->find($id);
    };
  }
}
