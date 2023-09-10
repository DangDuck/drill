<?php

namespace App\Controllers;

class ProsesPekerjaan extends BaseController
{
  public function index()
  {
    $prosesPekerjaanModel = new \App\Models\ProsesPekerjaanModel();
    $data = [
      'title' => 'Proses Pekerjaan',
      'data' => $prosesPekerjaanModel->get_data(),
    ];

    return view('admin/proses_pekerjaan/index', $data);
  }

  public function tambah_proses_pekerjaan()
  {
    $data = [
      'title' => 'Tambah Proses Pekerjaan',
      'action' => base_url() . '/' . 'proses_pekerjaan/tambah_proses_pekerjaan',
    ];

    return view('admin/proses_pekerjaan/detail', $data);
  }

  public function action_tambah_proses_pekerjaan()
  {
    $prosesPekerjaanModel = new \App\Models\ProsesPekerjaanModel();

    $data = [
      'nama' => $this->request->getPost('input_nama'),
      'urutan' => $this->request->getPost('input_urutan'),
      'kategori_mesin_id' => $this->request->getPost('input_kategori_mesin_id'),
      'kategori_pekerjaan_id' => $this->request->getPost('input_kategori_pekerjaan_id'),
    ];

    if ($prosesPekerjaanModel->insert($data)) {
      return redirect()->to('proses_pekerjaan');
    }
  }

  public function ubah_proses_pekerjaan($id)
  {
    $prosesPekerjaanModel = new \App\Models\ProsesPekerjaanModel();

    $data = [
      'title' => 'Ubah Proses Pekerjaan',
      'data' => $prosesPekerjaanModel->get_data($id),
      'action' => base_url() . '/' . 'proses_pekerjaan/ubah_proses_pekerjaan/' . $id,
    ];

    return view('admin/proses_pekerjaan/detail', $data);
  }

  public function action_ubah_proses_pekerjaan($id)
  {
    $prosesPekerjaanModel = new \App\Models\ProsesPekerjaanModel();

    $data = [
      'nama' => $this->request->getPost('input_nama'),
      'urutan' => $this->request->getPost('input_urutan'),
      'kategori_mesin_id' => $this->request->getPost('input_kategori_mesin_id'),
      'kategori_pekerjaan_id' => $this->request->getPost('input_kategori_pekerjaan_id'),
    ];

    if ($prosesPekerjaanModel->update($id, $data)) {
      return redirect()->to('proses_pekerjaan');
    }
  }

  public function action_hapus_proses_pekerjaan($id)
  {
    $prosesPekerjaanModel = new \App\Models\ProsesPekerjaanModel();

    if ($prosesPekerjaanModel->delete($id)) {
      return redirect()->to('proses_pekerjaan');
    };
  }
}
