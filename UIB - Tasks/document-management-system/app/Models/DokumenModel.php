<?php

namespace App\Models;

use CodeIgniter\Model;

class DokumenModel extends Model
{
  protected $table      = 'dokumen';
  protected $returnType = 'array';
  protected $useTimestamps = true;
  protected $allowedFields = ['jenis_dok', 'nama', 'path'];

  // untuk get ALL dokumen
  public function getDokumen($jenis_dok = false)
  {
    if ($jenis_dok == false) {
      return $this->findAll();
    };
    return $this->getWhere(['jenis_dok' => $jenis_dok])->getResultArray();
  }
}
