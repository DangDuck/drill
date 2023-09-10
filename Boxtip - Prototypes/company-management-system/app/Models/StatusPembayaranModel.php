<?php

namespace App\Models;

use CodeIgniter\Model;

class StatusPembayaranModel extends Model
{
  protected $table = 'status_pembayaran';

  public function getAllStatus()
  {
    return $this->findAll();
  }
}
