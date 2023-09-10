<?php

namespace App\Controllers;

class AlgoritmaController extends BaseController
{
  public function index()
  {
    $data = [
      'title' => 'Generasi Jadwal',
      'action' => base_url() . '/' . 'generate',
    ];
    return view('admin/algoritma/index', $data);
  }

  public function generate()
  {
    $population = new \App\Models\AlgoritmaGenetika();
    $data = [
      'title' => 'Hasil',
      'population' => $population->start_algorithm($this->request->getPost('input_pc'), $this->request->getPost('input_pm'), $this->request->getPost('input_total_gen'), $this->request->getPost('input_total_err')),
    ];

    return view('admin/algoritma/hasil', $data);
  }


  public function preview()
  {
    $pekerjaanLineModel = new \App\Models\PekerjaanLineModel();
    $data = [
      'title' => 'Preview Proses Pekerjaan',
      'data' => $pekerjaanLineModel->get_data(),
    ];

    return view('admin/algoritma/proses', $data);
  }

  public function update_line($id)
  {
    $pekerjaanLineModel = new \App\Models\PekerjaanLineModel();

    $data = [
      'title' => 'Ubah Line Pekerjaan',
      'data' => $pekerjaanLineModel->get_data($id),
      'action' => base_url() . '/' . 'pekerjaan_line/' . $id,
    ];

    return view('admin/algoritma/update_line', $data);
  }

  public function action_update_line($id)
  {
    $pekerjaanModel = new \App\Models\PekerjaanModel();
    $mesinModel = new \App\Models\MesinModel();
    $pekerjaanLineModel = new \App\Models\PekerjaanLineModel();

    $mesin_id = $mesinModel->get_data($this->request->getPost('mesin_id'));
    $pekerjaan_id = $pekerjaanModel->get_data($this->request->getPost('pekerjaan_id'));
    $waktu = $this->getWaktu($mesin_id, $pekerjaan_id['kuantitas']);

    $data = [
      'mesin_id'  => $mesin_id['id'],
      'waktu'     => $waktu,
    ];

    if ($pekerjaanLineModel->update($id, $data)) {
      return redirect()->to('preview_proses');
    }
  }

  public function getWaktu($mesin_id, $kuantitas)
  {
    return $kuantitas / $mesin_id['kapasitas'];
  }

  public function generate_line()
  {
    $pekerjaanLineModel = new \App\Models\PekerjaanLineModel();
    $pekerjaanModel = new \App\Models\PekerjaanModel();
    $prosesPekerjaanModel = new \App\Models\ProsesPekerjaanModel();

    $pekerjaan = $pekerjaanModel->get_data();
    $pekerjaanLineModel->emptyTable();

    foreach ($pekerjaan as $p) {
      $proses = $prosesPekerjaanModel->where('kategori_pekerjaan_id', $p['kategori_pekerjaan_id']['id'])->findAll();
      foreach ($proses as $pr) {
        $randomMesin = $this->getRandomMesin($pr['kategori_mesin_id']);
        $data = [
          'pekerjaan_id' => $p['id'],
          'urutan' => $pr['urutan'],
          'proses_id' => $pr['id'],
          'kategori_mesin_id' => $pr['kategori_mesin_id'],
          'mesin_id' => $randomMesin['id'],
          'waktu' => ceil($p['kuantitas'] / $randomMesin['kapasitas']),
        ];
        $pekerjaanLineModel->insert($data);
      }
    }

    return redirect()->to('preview_proses');
  }

  public function getRandomMesin($kategori)
  {
    $mesinModel = new \App\Models\MesinModel();

    $mesin = $mesinModel->where('kategori_mesin_id', $kategori)->findAll();
    $randMesin = rand(0, count($mesin) - 1);
    return $mesin[$randMesin];
  }
}
