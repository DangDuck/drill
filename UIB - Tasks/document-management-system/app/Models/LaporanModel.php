<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanModel extends Model
{
  protected $table      = 'laporan';
  protected $useTimestamps = true;
  protected $allowedFields = ['nama', 'alamat', 'no_dok', 'no_telp', 'tahap', 'catatan'];

  // untuk get ALL laporan
  public function getLaporan($id = false){
    if($id == false){
      return $this->findAll();
    }
    return $this->getWhere(['id' => $id])->getRowArray();
  }
}