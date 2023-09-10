<?php

namespace App\Controllers;

class Pekerjaan extends BaseController
{
  public function index()
  {
    $pekerjaanModel = new \App\Models\PekerjaanModel();
    $data = [
      'title' => 'Pekerjaan',
      'data' => $pekerjaanModel->get_data(),
    ];

    return view('admin/pekerjaan/index', $data);
  }

  public function tambah_pekerjaan()
  {
    $data = [
      'title' => 'Tambah Pekerjaan',
      'action' => base_url() . '/' . 'pekerjaan/tambah_pekerjaan',
    ];

    return view('admin/pekerjaan/detail', $data);
  }

  public function action_tambah_pekerjaan()
  {
    $pekerjaanModel = new \App\Models\PekerjaanModel();

    $data = [
      'nama' => $this->request->getPost('input_nama'),
      'kategori_pekerjaan_id' => $this->request->getPost('input_kategori_id'),
      'kuantitas' => $this->request->getPost('input_kuantitas'),
      'jatuh_tempo' => $this->request->getPost('input_jatuh_tempo'),
    ];

    if ($pekerjaanModel->insert($data)) {
      return redirect()->to('pekerjaan');
    }
  }

  public function ubah_pekerjaan($id)
  {
    $pekerjaanModel = new \App\Models\PekerjaanModel();

    $data = [
      'title' => 'Ubah Pekerjaan',
      'data' => $pekerjaanModel->get_data($id),
      'action' => base_url() . '/' . 'pekerjaan/ubah_pekerjaan/' . $id,
    ];

    return view('admin/pekerjaan/detail', $data);
  }

  public function action_ubah_pekerjaan($id)
  {
    $pekerjaanModel = new \App\Models\PekerjaanModel();

    $data = [
      'nama' => $this->request->getPost('input_nama'),
      'kategori_pekerjaan_id' => $this->request->getPost('input_kategori_id'),
      'kuantitas' => $this->request->getPost('input_kuantitas'),
      'jatuh_tempo' => $this->request->getPost('input_jatuh_tempo'),
    ];

    if ($pekerjaanModel->update($id, $data)) {
      return redirect()->to('pekerjaan');
    }
  }

  public function action_hapus_pekerjaan($id)
  {
    $pekerjaanModel = new \App\Models\PekerjaanModel();

    if ($pekerjaanModel->delete($id)) {
      return redirect()->to('pekerjaan');
    };
  }
}
