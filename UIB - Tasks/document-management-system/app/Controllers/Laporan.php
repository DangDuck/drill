<?php namespace App\Controllers;

use App\Models\LaporanModel;

class Laporan extends BaseController
{
    protected $laporanModel;

    public function __construct()
    {
        $this->laporanModel = new LaporanModel();
    }

    public function index()
    {
        if(session()->get('username') == ''){
            return redirect()->to('home');
        }
        $data = [
            'title' => 'Laporan P. UWTO & SHGB',
            'sub' => 'Laporan',
            'laporan' => $this->laporanModel->getLaporan(),
        ];
        return view('laporan/index', $data);
    }

    public function input()
    {
        if(session()->get('username') == ''){
            return redirect()->to('home');
        }
        $data = [
            'title' => 'Laporan P. UWTO & SHGB',
            'sub' => 'Input Laporan',
            'validation' => \Config\Services::validation(),
        ];
        return view('laporan/input', $data);
    }

    // untuk tambah laporan
    public function add()
    {
        /*
        VALIDASI
        */
        // gagal validasi
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi',
                ],
            ],
            'no_dok' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi',
                ],
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi',
                ],
            ],
            'tahap' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi',
                ],
            ],
            'no_telp' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi',
                ],
            ],
            'catatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi',
                ],
            ],
        ])) {
            return redirect()->to('/laporan/input')->withInput();
        }

        // berhasil validasi

        $this->laporanModel->save([
          'nama' => $this->request->getVar('nama'),
          'alamat' => $this->request->getVar('alamat'),
          'no_dok' => $this->request->getVar('no_dok'),
          'no_telp' => $this->request->getVar('no_telp'),
          'tahap' => $this->request->getVar('tahap'),
          'catatan' => $this->request->getVar('catatan')
          ]
        );
        session()->setFlashdata('info', 'Laporan berhasil ditambah');
        return redirect()->to('/laporan');
    }

    // untuk hapus laporan
    public function delete($id){
        if(session()->get('username') == ''){
            return redirect()->to('home');
        }
        $this->laporanModel->delete($id);
        session()->setFlashdata('info', 'Laporan berhasil dihapus');
        return redirect()->to('/laporan/index');
    }

    // untuk tampilan edit laporan
    public function edit($id){
        if(session()->get('username') == ''){
            return redirect()->to('home');
        }
        $data = [
            'title' => 'Laporan P. UWTO & SHGB',
            'sub' => 'Ubah Laporan',
            'laporan' => $this->laporanModel->getLaporan($id),
            'validation' => \Config\Services::validation(),
        ];
        return view('laporan/edit', $data);
    }

    // untuk update laporan
    public function update($id){
        /*
         * VALIDASI 
         */
        // gagal validasi
        if(!$this->validate([
            'tahap' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi',
                ],
            ],
            'catatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi',
                ],
            ],
        ])){
            return redirect()->to('/laporan/edit/' . $id)->withInput();
        }
        $this->laporanModel->save([
            'id' => $id,
            'tahap' => $this->request->getVar('tahap'),
            'catatan' => $this->request->getVar('catatan')
        ]);
        session()->setFlashdata('info', 'Data berhasil diubah');
        return redirect()->to('/laporan');
    }
}
