<?php

namespace App\Controllers;

class KategoriPekerjaan extends BaseController
{
  public function index()
  {
    $kategoriPekerjaanModel = new \App\Models\KategoriPekerjaanModel();
    $data = [
      'title' => 'Kategori Pekerjaan',
      'data' => $kategoriPekerjaanModel->get_data(),
    ];

    return view('admin/kategori_pekerjaan/index', $data);
  }

  public function tambah_kategori_pekerjaan()
  {
    $data = [
      'title' => 'Tambah Kategori Pekerjaan',
      'action' => base_url() . '/' . 'kategori_pekerjaan/tambah_kategori_pekerjaan',
    ];

    return view('admin/kategori_pekerjaan/detail', $data);
  }

  public function action_tambah_kategori_pekerjaan()
  {
    $kategoriPekerjaanModel = new \App\Models\KategoriPekerjaanModel();

    $data = [
      'nama' => $this->request->getPost('input_nama'),
    ];

    if ($kategoriPekerjaanModel->insert($data)) {
      return redirect()->to('kategori_pekerjaan');
    }
  }

  public function ubah_kategori_pekerjaan($id)
  {
    $kategoriPekerjaanModel = new \App\Models\KategoriPekerjaanModel();

    $data = [
      'title' => 'Ubah Kategori Pekerjaan',
      'data' => $kategoriPekerjaanModel->get_data($id),
      'action' => base_url() . '/' . 'kategori_pekerjaan/ubah_kategori_pekerjaan/' . $id,
    ];

    return view('admin/kategori_pekerjaan/detail', $data);
  }

  public function action_ubah_kategori_pekerjaan($id)
  {
    $kategoriPekerjaanModel = new \App\Models\KategoriPekerjaanModel();

    $data = [
      'nama' => $this->request->getPost('input_nama'),
    ];

    if ($kategoriPekerjaanModel->update($id, $data)) {
      return redirect()->to('kategori_pekerjaan');
    }
  }

  public function action_hapus_kategori_pekerjaan($id)
  {
    $kategoriPekerjaanModel = new \App\Models\KategoriPekerjaanModel();

    if ($kategoriPekerjaanModel->delete($id)) {
      return redirect()->to('kategori_pekerjaan');
    };
  }
}
