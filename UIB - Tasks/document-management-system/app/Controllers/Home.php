<?php

namespace App\Controllers;

use App\Models\HomeModel;

class Home extends BaseController
{
    protected $homeModel;

    public function __construct()
    {
        $this->homeModel = new HomeModel();
    }
    // add
    public function add()
    {
        if (!$this->validate([
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isi {field} yang benar',
                ],
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isi {field} yang benar',
                ],
            ],
        ])) {
            return redirect()->to('/home')->withInput();
        }

        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $this->homeModel->addUser($username, $password);
    }

    // login
    public function index()
    {
        if (session()->get('username') != '') {
            return redirect()->to('ardok');
        }
        $data = [
            'title' => 'Login',
            'validation' => \Config\Services::validation(),
        ];
        return view('index', $data);
    }

    // auth
    public function auth()
    {
        /*
        VALIDASI
         */
        // gagal validasi
        if (!$this->validate([
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isi {field} yang benar',
                ],
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isi {field} yang benar',
                ],
            ],
        ])) {
            return redirect()->to('/home')->withInput();
        }

        // sukses validasi
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $dataLogin = $this->homeModel->getUser($username);

        if (password_verify($password, $dataLogin['password'])) {
            $dataUser = [
                'username' => $dataLogin['username'],
            ];
            session()->set($dataUser);
            return redirect()->to('/ardok');
        } else {
            session()->setFlashdata('info', 'Invalid Password');
            return redirect()->to('/home');
        };
    }

    // update password
    public function updatePass()
    {
        if (session()->get('username') == '') {
            return redirect()->to('home');
        }
        $data = [
            'title' => 'Update Password',
            'validation' => \Config\Services::Validation(),
        ];
        return view('home/upass', $data);
    }

    public function savePass()
    {
        /**
         * VALIDASI
         */
        // gagal validasi
        if (!$this->validate([
            'oldPass' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan password anda',
                ],
            ],
            'newPass' => [
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => 'Masukkan password baru anda',
                    'min_length' => 'Panjang password minimal 8 karakter',
                ],
            ],
            'rePass' => [
                'rules' => 'required|matches[newPass]',
                'errors' => [
                    'required' => 'Masukkan ulang password anda',
                    'matches' => 'Pengulangan password tidak sesuai'
                ],
            ],
        ])) {
            return redirect()->to('/home/updatePass')->withInput();
        };
        // berhasil validasi
        $dataUser = $this->homeModel->getUser(session()->get('username'));
        $oldPass = $this->request->getVar('oldPass');
        $newPass = $this->request->getVar('newPass');

        if (password_verify($oldPass, $dataUser['password'])) {
            $this->homeModel->save([
                'id' => $dataUser['id'],
                'password' => password_hash($newPass, PASSWORD_DEFAULT)
            ]);
            session()->setFlashdata('info', 'Password berhasil diubah');
            return redirect()->to('/home/updatePass');
        };
    }

    // logout
    public function logout()
    {
        if (session()->get('username') == '') {
            return redirect()->to('home');
        }

        session()->remove('username');
        session()->remove('password');

        return redirect()->to('/home');
    }
}
