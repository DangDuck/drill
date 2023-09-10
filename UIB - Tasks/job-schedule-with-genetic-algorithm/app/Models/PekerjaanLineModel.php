<?php

namespace App\Models;

use CodeIgniter\Model;

class PekerjaanLineModel extends Model
{
  protected $table      = 'pekerjaan_line';
  protected $allowedFields = ['pekerjaan_id', 'urutan', 'proses_id', 'kategori_mesin_id', 'mesin_id', 'waktu'];

  public function get_data($id = False)
  {
    $kategoriMesinModel = model('App\Models\KategoriMesinModel', false);
    $pekerjaanModel = model('App\Models\PekerjaanModel', false);
    $mesinModel = model('App\Models\MesinModel', false);
    $prosesPekerjaanModel = model('App\Models\ProsesPekerjaanModel', false);

    if (!$id) {
      $data = $this->findAll();
      for ($i = 0; $i < count($data); $i++) {
        $data[$i]['pekerjaan_id'] = $pekerjaanModel->find($data[$i]['pekerjaan_id']);
        $data[$i]['proses_id'] = $prosesPekerjaanModel->find($data[$i]['proses_id']);
        $data[$i]['kategori_mesin_id'] = $kategoriMesinModel->find($data[$i]['kategori_mesin_id']);
        if ($data[$i]['mesin_id']) {
          $data[$i]['mesin_id'] = $mesinModel->find($data[$i]['mesin_id']);
        }
      }
      return $data;
    } else {
      $data = $this->find($id);
      $data['pekerjaan_id'] = $pekerjaanModel->find($data['pekerjaan_id']);
      $data['proses_id'] = $prosesPekerjaanModel->find($data['proses_id']);
      $data['kategori_mesin_id'] = $kategoriMesinModel->find($data['kategori_mesin_id']);
      if ($data['mesin_id']) {
        $data['mesin_id'] = $mesinModel->find($data['mesin_id']);
      }
      return $data;
    };
  }
  public function get_by_sequence_and_job_id($job_id, $sequence)
  {
    $line = $this->where('pekerjaan_id', $job_id)->where('urutan', $sequence)->first();
    return [$line['id'], $line['mesin_id'], $line['waktu']];
  }
  public function get_html_data($job_id, $sequence)
  {
    $kategoriMesinModel = model('App\Models\KategoriMesinModel', false);
    $pekerjaanModel = model('App\Models\PekerjaanModel', false);
    $mesinModel = model('App\Models\MesinModel', false);
    $prosesPekerjaanModel = model('App\Models\ProsesPekerjaanModel', false);
    $data = $this->where('pekerjaan_id', $job_id)->where('urutan', $sequence)->first();

    $data['pekerjaan_id'] = $pekerjaanModel->find($data['pekerjaan_id'])['nama'];
    $data['proses_id'] = $prosesPekerjaanModel->find($data['proses_id'])['nama'];
    $data['kategori_mesin_id'] = $kategoriMesinModel->find($data['kategori_mesin_id'])['nama'];
    $data['mesin_id'] = $mesinModel->find($data['mesin_id'])['nama'];
    return $data;
  }
}
