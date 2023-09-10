<?php

namespace App\Models;

use CodeIgniter\Model;

class ProsesPekerjaanModel extends Model
{
  protected $table      = 'proses_pekerjaan';
  protected $allowedFields = ['nama', 'urutan', 'kategori_pekerjaan_id', 'kategori_mesin_id'];

  public function get_data($id = False)
  {
    $kategoriPekerjaanModel = model('App\Models\KategoriPekerjaanModel', false);
    $kategoriMesinModel = model('App\Models\KategoriMesinModel', false);
    if (!$id) {
      $data = $this->findAll();
      for ($i = 0; $i < count($data); $i++) {
        $data[$i]['kategori_pekerjaan_id'] = $kategoriPekerjaanModel->find($data[$i]['kategori_pekerjaan_id'])['nama'];
        $data[$i]['kategori_mesin_id'] = $kategoriMesinModel->find($data[$i]['kategori_mesin_id'])['nama'];
      }
      return $data;
    } else {
      return $this->find($id);
    };
  }
}
