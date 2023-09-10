<?php

namespace App\Models;

use CodeIgniter\Model;

class DataModel extends Model
{
  public function getLoginData($username)
  {
    $query = $this->db->query("SELECT customer.id AS id_customer, user.password AS password, customer.nama AS nama, customer.customer_code AS customer_code, user.username, user.id_role AS id_role FROM user JOIN customer ON user.id_customer = customer.id WHERE user.username = '$username'")->getRowArray();
    return $query;
  }

  public function getCustomerData($username)
  {
    $builder = $this->db->table('user');
  }
}
