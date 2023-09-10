<?php

namespace App\Controllers;

class KategoriMesin extends BaseController
{
  public function index()
  {
    $kategoriMesinModel = new \App\Models\KategoriMesinModel();
    $data = [
      'title' => 'Kategori Mesin',
      'data' => $kategoriMesinModel->get_data(),
    ];
    return view('admin/kategori_mesin/index', $data);
  }

  public function tambah_kategori_mesin()
  {
    $data = [
      'title' => 'Tambah Kategori Mesin',
      'action' => base_url() . '/' . 'kategori_mesin/tambah_kategori_mesin',
    ];

    return view('admin/kategori_mesin/detail', $data);
  }

  public function action_tambah_kategori_mesin()
  {
    $kategoriMesinModel = new \App\Models\KategoriMesinModel();

    $data = [
      'nama' => $this->request->getPost('input_nama'),
    ];

    if ($kategoriMesinModel->insert($data)) {
      return redirect()->to('kategori_mesin');
    }
  }

  public function ubah_kategori_mesin($id)
  {
    $kategoriMesinModel = new \App\Models\KategoriMesinModel();

    $data = [
      'title' => 'Ubah Kategori Mesin',
      'data' => $kategoriMesinModel->get_data($id),
      'action' => base_url() . '/' . 'kategori_mesin/ubah_kategori_mesin/' . $id,
    ];

    return view('admin/kategori_mesin/detail', $data);
  }

  public function action_ubah_kategori_mesin($id)
  {
    $kategoriMesinModel = new \App\Models\KategoriMesinModel();

    $data = [
      'nama' => $this->request->getPost('input_nama'),
    ];

    if ($kategoriMesinModel->update($id, $data)) {
      return redirect()->to('kategori_mesin');
    }
  }

  public function action_hapus_kategori_mesin($id)
  {
    $kategoriMesinModel = new \App\Models\KategoriMesinModel();

    if ($kategoriMesinModel->delete($id)) {
      return redirect()->to('kategori_mesin');
    };
  }
}
