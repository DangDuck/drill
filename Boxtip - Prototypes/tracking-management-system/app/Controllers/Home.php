<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		$data = [
			'validation' => \Config\Services::validation(),
		];
		return view('public/home', $data);
	}

	public function track()
	{
		if (!$this->validate([
			'lacak' => [
				'label' => 'Nomor Resi',
				'rules' => 'required',
				'errors' => [
					'required' => '{field} wajib diisi!'
				]
			]
		])) {
			return redirect()->to('/')->withInput();
		} else {
			// get input
			$resi = $this->request->getVar('lacak');
			// connect database
			$db = \Config\Database::connect();
			$result = $db->table('resi')->select('status.status, resi.*')->join('status', 'status.id = resi.status_id')->where('no_resi', $resi)->get()->getRowArray();
			$data = [
				'validation' => \Config\Services::validation(),
				'result' => (empty($result)) ? [] : $result
			];
			return view('public/home', $data);
		}
	}
}
