<?php

namespace App\Models;

use CodeIgniter\Model;

class MesinModel extends Model
{
  protected $table      = 'mesin';
  protected $allowedFields = ['nama', 'kategori_mesin_id', 'kapasitas'];

  public function get_data($id = False)
  {
    $kategoriMesinModel = model('App\Models\KategoriMesinModel', false);
    if (!$id) {
      $data = $this->findAll();
      for ($i = 0; $i < count($data); $i++) {
        $data[$i]['kategori_mesin_id'] = $kategoriMesinModel->find($data[$i]['kategori_mesin_id'])['nama'];
      }
      return $data;
    } else {
      return $this->find($id);
    };
  }

  public function get_id_only()
  {
    $mesin = $this->select('id')->orderBy('id')->get()->getResultArray();
    $mesin_id = [];
    foreach ($mesin as $ms) {
      $mesin_id[] = $ms['id'];
    }
    return $mesin_id;
  }
}
