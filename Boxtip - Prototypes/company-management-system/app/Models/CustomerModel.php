<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
  protected $table = 'customer';
  protected $useSoftDeletes = true;
  protected $useTimestamps = true;
  protected $allowedFields = ['customer_code', 'nama', 'nomor_telpon', 'alamat', 'instagram'];

  // all customer
  public function getCustomer()
  {
    return $this->db->query("SELECT * FROM customer WHERE customer_code NOT LIKE 'BX000' AND deleted_at LIKE '0000-00-00 00:00:00'")->getResultArray();
  }

  // data customer
  public function getDataCustomer($id_customer)
  {
    return $this->db->query("SELECT * FROM customer WHERE id = $id_customer")->getRowArray();
  }

  // data customer by customer code
  public function getDataByCustomerCode($customer_code)
  {
    return $this->db->query("SELECT * FROM customer WHERE customer_code = '$customer_code'")->getRowArray();
  }

  // last customer
  public function getLastCustomer()
  {
    return $this->db->query(
      "SELECT *
      FROM customer
      ORDER BY id DESC LIMIT 1"
    )->getRowArray();
  }

  // all customer code
  public function getAllCustomerCode()
  {
    return $this->db->query("SELECT id, customer_code, nama FROM customer WHERE customer_code NOT LIKE 'BX000'")->getResultArray();
  }
}
