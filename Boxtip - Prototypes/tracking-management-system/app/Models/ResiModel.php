<?php

namespace App\Models;

use CodeIgniter\Model;

class ResiModel extends Model
{
  protected $table = 'resi';
  protected $allowedFields = ['no_resi'];
  public function getResi()
  {
    return $this->findAll();
  }
  public function checkDuplicate($no_resi)
  {
    return $this->where('no_resi', $no_resi)->countAllResults();
  }
  public function checkStatus($no_resi, $status)
  {
    // get data
    $data = $this->where('no_resi', $no_resi)->first();
    $data = array_values($data);
    // if statusnya = 1, then check data warehouse_at[3], // if statusnya = 2, then check data eta_at[4],  // if statusnya = 3, then check data process_at[5], // if statusnya =4, then check data delivery_at[6], // if statusnya = 5, then check data closed_at[7]
    ($status == 1) ? $status = $status + 1 : $status = $status;
    if ($data[$status + 1] <= 0) {
      return 'skip';
    } else {
      return 'ok';
    }
  }
  public function getResiById($id)
  {
    return $this->find($id);
  }
}
