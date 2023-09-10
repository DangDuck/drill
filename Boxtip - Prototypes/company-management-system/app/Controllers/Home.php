<?php

namespace App\Controllers;

// model
use App\Models\DataModel;
use App\Models\UserModel;

class Home extends BaseController
{
	// global var
	protected $dataModel;
	protected $userModel;

	public function __construct()
	{
		$this->dataModel = new DataModel();
		$this->userModel = new UserModel();
	}

	// login
	public function index()
	{
		// ada username
		if (session()->get('username')) {
			if (session()->get('id_role') == 1) {
				return redirect()->to('/master');
			} else {
				return redirect()->to('/menu');
			}
		}

		$data = [
			'title' => 'Login',
			'validation' => \Config\Services::validation(),
		];

		return view('home/index', $data);
	}

	// auth login
	public function auth()
	{
		// ada username
		if (session()->get('username')) {
			if (session()->get('id_role') == 1) {
				return redirect()->to('/master');
			} else {
				return redirect()->to('/menu');
			}
		}

		// invalid
		if (!$this->validate([
			'username' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Masukkan Username Anda!'
				],
			],
			'password' => [
				'rules' => 'required|min_length[8]',
				'errors' => [
					'required' => 'Masukkan Password Anda!',
					'min_length' => 'Panjang Password Min. 8 Digit!'
				],
			],
		])) {
			return redirect()->to('/home')->withInput();
		};

		// valid
		$dataLogin = $this->dataModel->getLoginData($this->request->getVar('username'));

		// user not found
		if (!$dataLogin) {
			session()->setFlashdata('info', 'Invalid Username and Password');
			return redirect()->to('/home')->withInput();
		}

		if (password_verify($this->request->getVar('password'), $dataLogin['password'])) {

			// setup session
			session()->set([
				'customer_code' => $dataLogin['customer_code'],
				'nama' => $dataLogin['nama'],
				'username' => $dataLogin['username'],
				'id_role' => $dataLogin['id_role'],
				'id_customer' => $dataLogin['id_customer']
			]);

			// divert
			if ($dataLogin['id_role'] == 1) {
				return redirect()->to('/master')->withInput();
			} else if ($dataLogin['id_role'] == 2) {
				return redirect()->to('/menu')->withInput();
			}
		} else {
			session()->setFlashdata('info', 'Invalid Username and Password');
			return redirect()->to('/home')->withInput();
		}
	}

	public function changePassword()
	{

		// tidak ada username
		if (session()->get('username') == '') {
			return redirect()->to('/home');
		}

		$data = [
			'title' => 'Change Password',
			'validation' => \Config\Services::validation()
		];

		return view('menu/changepassword', $data);
	}

	public function newPassword()
	{
		if (!$this->validate([
			'oldPassword' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Masukkan password sekarang'
				]
			],
			'password' => [
				'rules' => 'required|min_length[8]',
				'errors' => [
					'required' => 'Masukkan password baru',
					'min_length' => 'Panjang password minimal 8 karakter'
				]
			],
			'rePassword' => [
				'rules' => 'required|min_length[8]|matches[password]',
				'errors' => [
					'required' => 'Masukkan kembali password',
					'min_length' => 'Panjang password minimal 8 karakter',
					'matches' => 'Password yang dimasukkan tidak sama'
				]
			]
		])) {
			return redirect()->to('/home/changepassword')->withInput();
		}

		// amabil data
		$old = $this->request->getVar('oldPassword');
		$re = $this->request->getVar('rePassword');
		$dataLogin = $this->dataModel->getLoginData(session()->get('username'));
		if (password_verify($old, $dataLogin['password'])) {
			$this->userModel->update(session()->get('username'), [
				'password' => password_hash($re, PASSWORD_DEFAULT),
			]);

			session()->setFlashdata('info', 'password-changed');
		} else {
			session()->setFlashdata('info', 'password-wrong');
		}
		return redirect()->to('/home/changepassword');
	}

	// logout
	public function logout()
	{
		// remove session
		session()->remove('customer_code');
		session()->remove('nama');
		session()->remove('id_role');
		session()->remove('username');
		session()->remove('id_customer');

		// back to login
		session()->setFlashdata('info', 'Logged Out');
		return redirect()->to('/home');
	}

	//--------------------------------------------------------------------

}
