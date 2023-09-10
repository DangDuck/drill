<?php

namespace App\Controllers;

class User extends BaseController
{
  public function index()
  {
    //dosomething
    // if (session()->get('login') != true) {
    //   return redirect()->to('/');
    // }
    return redirect()->to('/');
  }
  private function register()
  {
    $db = \Config\Database::connect();
    $data = [
      'username' => 'admin',
      'password' => password_hash('123456', PASSWORD_DEFAULT)
    ];
    return $db->table('user')->insert($data);
  }
  public function auth()
  {
    if (!$this->validate([
      'username' => [
        'label' => 'Username',
        'rules' => 'required',
        'errors' => [
          'required' => '{field} wajib diisi'
        ]
      ],
      'password' => [
        'label' => 'Password',
        'rules' => 'required',
        'errors' => [
          'required' => '{field} wajib diisi'
        ]
      ]
    ])) {
      return redirect()->to('/')->withInput();
    }
    $username =  $this->request->getVar('username');
    $password = $this->request->getVar('password');
    $db = \Config\Database::connect();
    $user = $db->table('user')->getWhere(['username' => $username])->getRowArray();
    if ($user) {
      if (password_verify($password, $user['password'])) {
        session()->set('username', $username);
        session()->set('login', true);
        return redirect()->to('/admin');
      } else {
        session()->setFlashdata('info', 'error');
        return redirect()->to('/');
      }
    } else {
      session()->setFlashdata('info', 'error');
      return redirect()->to('/');
    }
  }
  public function logout()
  {
    if (session()->get('login') != true) {
      return redirect()->to('/');
    }
    session()->destroy();
    return redirect()->to('/');
  }
}
