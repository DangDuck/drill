<?php

namespace App\Controllers;

class Mesin extends BaseController
{
  public function index()
  {
    $mesinModel = new \App\Models\MesinModel();
    $data = [
      'title' => 'Mesin',
      'data' => $mesinModel->get_data(),
    ];

    return view('admin/mesin/index', $data);
  }

  public function tambah_mesin()
  {
    $data = [
      'title' => 'Tambah Mesin',
      'action' => base_url() . '/' . 'mesin/tambah_mesin',
    ];

    return view('admin/mesin/detail', $data);
  }

  public function action_tambah_mesin()
  {
    $mesinModel = new \App\Models\MesinModel();

    $data = [
      'nama' => $this->request->getPost('input_nama'),
      'kategori_mesin_id' => $this->request->getPost('input_kategori_mesin_id'),
      'kapasitas' => $this->request->getPost('input_kapasitas'),
    ];

    if ($mesinModel->insert($data)) {
      return redirect()->to('mesin');
    }
  }

  public function ubah_mesin($id)
  {
    $mesinModel = new \App\Models\MesinModel();

    $data = [
      'title' => 'Ubah Mesin',
      'data' => $mesinModel->get_data($id),
      'action' => base_url() . '/' . 'mesin/ubah_mesin/' . $id,
    ];

    return view('admin/mesin/detail', $data);
  }

  public function action_ubah_mesin($id)
  {
    $mesinModel = new \App\Models\MesinModel();

    $data = [
      'nama' => $this->request->getPost('input_nama'),
      'kategori_mesin_id' => $this->request->getPost('input_kategori_mesin_id'),
      'kapasitas' => $this->request->getPost('input_kapasitas'),
    ];

    if ($mesinModel->update($id, $data)) {
      return redirect()->to('mesin');
    }
  }

  public function action_hapus_mesin($id)
  {
    $mesinModel = new \App\Models\MesinModel();

    if ($mesinModel->delete($id)) {
      return redirect()->to('mesin');
    };
  }
}
