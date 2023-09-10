<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('home/index');
    }

    public function auth()
    {
        $usersModel = model('App\Models\UsersModel', false);
        $data = [
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password'),
        ];

        $result = $usersModel->where(['username' => $data['username'], 'password' => $data['password']])->find();

        if ($result) {
            $this->session->set($data);
            return redirect()->to('pekerjaan')->withInput();
        } else {
            return view('home/index');
        };
    }
}
