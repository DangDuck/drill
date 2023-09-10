<?php

namespace App\Models;

use CodeIgniter\Model;

class HomeModel extends Model
{
  protected $table      = 'user';
  protected $returnType = 'array';
  protected $useTimestamps = true;
  protected $allowedFields = ['username', 'password'];

  // untuk add new user
  public function addUser($username, $password)
  {
    $password = password_hash($password, PASSWORD_DEFAULT);
    $data = [
      'username' => $username,
      'password' => $password
    ];
    return $this->db->table('user')->insert($data);
  }

  // untuk get data user tertentu
  public function getUser($username)
  {
    $builder = $this->db->table('user');
    return $builder->getWhere(['username' => $username])->getRowArray();
  }
}
