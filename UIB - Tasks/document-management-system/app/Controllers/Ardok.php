<?php namespace App\Controllers;

use App\Models\DokumenModel;

class Ardok extends BaseController
{
  protected $dokumenModel;

  public function __construct()
  {
    $this->dokumenModel = new DokumenModel();
  }

  // untuk tampilkan semua arsipan
  public function index(){
    if(session()->get('username') == ''){
      return redirect()->to('home');
    }
    $data = [
      'title' => 'Arsip Dokumen',
      'dokumen' => $this->dokumenModel->getDokumen(),
      'validation' => \Config\Services::validation(),
    ];
    return view('ardok/index', $data);
  }

  // untuk upload file
  public function upload(){
    /**
     * VALIDASI
     */
    // gagal validasi
    if (!$this->validate([
      'nama' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Field Nama harus diisi'
        ]
        ],
      'jenis_dok' => [
        'rules' => 'required',
        'errors' => [
          'required' => '{field} harus dipilih'
        ]
        ],
      'uploadFile' => [
        'rules' => 'uploaded[uploadFile]|max_size[uploadFile,10240]|mime_in[uploadFile,application/pdf]|ext_in[uploadFile,pdf]',
        'errors' => [
          'uploaded' => 'Pilih file untuk diupload',
          'max_size' => 'Ukuran file terlalu besar, maksimal 10MB',
          'mime_in' => 'Yang anda pilih bukan file PDF',
          'ext_in' => 'Ekstensi file anda bukan PDF'
        ]
        ]
    ])){
      return redirect()->to('/ardok')->withInput();
    };
    $file = $this->request->getFile('uploadFile');
    // ambil nama file sampul
    $namaFile = $file->getRandomName();
    // pindahkan file ke folder dokumen
    $file->move('dokumen', $namaFile);

    $this->dokumenModel->save([
      'jenis_dok' => $this->request->getVar('jenis_dok'),
      'nama' => $this->request->getVar('nama'),
      'path' => $namaFile,
    ]);
    session()->setFlashdata('info', 'File berhasil diupload');
    return redirect()->to('/ardok');
  }

  public function download($fileName){
    return $this->response->download('/dokumen/${fileName}', null);
  }

  // untuk tampilin arsip sesuai jenis
  public function arsip($jenis = false){
    if(session()->get('username') == ''){
      return redirect()->to('home');
    }
    switch ($jenis){
      case 'akta':
        $jenis = "Akta PT";
        break;
      case 'nib':
        $jenis = 'NIB';
        break;
      case 'npwp':
        $jenis = 'NPWP';
        break;
      case 'ktp':
        $jenis = 'KTP';
        break;
      case 'pl':
        $jenis = 'PL';
        break;
      case 'shgb':
        $jenis = 'SHGB';
        break;
      case 'skepsppl':
        $jenis = 'SKEP & SPPL';
        break;
      case 'dokinduk':
        $jenis = 'Dok. Induk';
        break;
      default:
        $jenis = false;
        break;
    }
    $data = [
      'title' => 'Arsip Dokumen',
      'dokumen' => $this->dokumenModel->getDokumen($jenis),
      'validation' => \Config\Services::validation(),
    ];
    return view("ardok/index", $data);
  }

  // untuk hapus dokumen
  public function delete($id){
    if(session()->get('username') == ''){
      return redirect()->to('home');
    }
    $dokumen = $this->dokumenModel->find($id);
    // cek default
    if ($dokumen['path'] != 'default.jpg') {
        // hapus gambar
        unlink('dokumen/' . $dokumen['path']);
    }
    $this->dokumenModel->delete($id);
    session()->setFlashdata('info', 'Dokumen berhasil dihapus');
    return redirect()->to('/ardok');
  }

}
