<?php

namespace App\Models;

use CodeIgniter\Model;

class StatusResiModel extends Model
{
  protected $table = 'status_resi';
  protected $allowedFields = ['status', 'keterangan'];

  public function getAllStatus()
  {
    return $this->findAll();
  }
}
