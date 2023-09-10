<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
  protected $table = 'user';
  protected $primaryKey = 'username';
  protected $allowedFields = ['username', 'password', 'id_customer', 'id_role'];

  public function getAllUser()
  {
    // CUSTOMER CODE, NAMA CUSTOMER, INSTAGRAM, USERNAME
    return $this->db->query("SELECT customer.customer_code AS customer_code, customer.nama AS nama, customer.instagram AS instagram, user.username AS username FROM customer LEFT JOIN user ON customer.id = user.id_customer WHERE customer.customer_code NOT LIKE 'BX000' AND customer.deleted_at LIKE '0000-00-00 00:00:00'")->getResultArray();
  }
}
