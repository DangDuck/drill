<?php

namespace App\Controllers;

use App\Models\ResiModel;


class Admin extends BaseController
{
  protected $resiModel;
  public function index()
  {
    if (session()->get('login') != true) {
      return redirect()->to('/');
    }
    $db = \Config\Database::connect();
    $this->resiModel = new ResiModel();

    $data = [
      'validation' => \Config\Services::validation(),
      'resi' => $db->table('resi')->select('status.status, resi.*')->join('status', 'resi.status_id = status.id')->orderBy('id', 'desc')->get()->getResultArray()
    ];
    return view('private/index', $data);
  }

  public function import()
  {
    if (session()->get('login') != true) {
      return redirect()->to('/');
    }
    if (!$this->validate(
      [
        'import' => [
          'label' => 'Inputan File',
          'rules' => 'uploaded[import]|ext_in[import,xls,xlsx]',
          'errors' => [
            'uploaded' => '{field} wajib diisi',
            'ext_in' => '{field} harus ekstensi xls & xlsx'
          ]
        ],
        'statusImport' => [
          'label' => 'Status',
          'rules' => 'required',
          'errors' => [
            'required' => '{field} wajib'
          ]
        ]
      ]
    )) {
      //failed
      return redirect()->to('/admin')->withInput();
    } else {
      //succeed
      $status = htmlspecialchars($this->request->getVar('statusImport'));
      $file_excel = $this->request->getFile('import');
      $ext = $file_excel->getClientExtension();
      if ($ext == "xls") {
        $render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
      } else {
        $render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
      }
      $spreadsheet = $render->load($file_excel);
      $data = $spreadsheet->getActiveSheet()->toArray();
      $this->resiModel = new ResiModel();
      $db = \Config\Database::connect();
      foreach ($data as $x => $row) {
        if ($x == 0) {
          continue;
        }
        $resi = $row[1];
        //check status and prepare value to insert/update
        switch ($status) {
          case 1:
            // check unique
            $check = $this->resiModel->checkDuplicate($resi);
            if ($check == 1) {
              session()->setFlashdata('duplicate', $resi);
              return redirect()->to('/admin')->withInput();
            } else {
              // unique
              $value[] = [
                'no_resi' => $resi,
                'status_id' => 1,
                'warehouse_at' => time()
              ];
            }
            break;
          case 2:
            // check exist
            $check = $this->resiModel->checkDuplicate($resi);
            // exist
            if ($check == 1) {
              // check status
              $checkStatus = $this->resiModel->checkStatus($resi, $status);
              // previous status filled
              if ($checkStatus == 'ok') {
                $value[] = [
                  'no_resi' => $resi,
                  'status_id' => 2,
                  'eta_at' => time()
                ];
              } else {
                session()->setFlashdata('skipped', $resi);
                return redirect()->to('/admin')->withInput();
              }
            } else {
              session()->setFlashdata('skipped', $resi);
              return redirect()->to('/admin')->withInput();
            }
            break;
          case 3:
            // check exist
            $check = $this->resiModel->checkDuplicate($resi);
            // exist
            if ($check == 1) {
              // check status
              $checkStatus = $this->resiModel->checkStatus($resi, $status);
              // previous status filled
              if ($checkStatus == 'ok') {
                $value[] = [
                  'no_resi' => $resi,
                  'status_id' => 3,
                  'process_at' => time()
                ];
              } else {
                session()->setFlashdata('skipped', $resi);
                return redirect()->to('/admin')->withInput();
              }
            } else {
              session()->setFlashdata('skipped', $resi);
              return redirect()->to('/admin')->withInput();
            }
            break;
          case 4:
            // check exist
            $check = $this->resiModel->checkDuplicate($resi);
            // exist
            if ($check == 1) {
              // check status
              $checkStatus = $this->resiModel->checkStatus($resi, $status);
              // previous status filled
              if ($checkStatus == 'ok') {
                $value[] = [
                  'no_resi' => $resi,
                  'status_id' => 4,
                  'delivery_at' => time()
                ];
              } else {
                session()->setFlashdata('skipped', $resi);
                return redirect()->to('/admin')->withInput();
              }
            } else {
              session()->setFlashdata('skipped', $resi);
              return redirect()->to('/admin')->withInput();
            }
            break;
          case 5:
            // check exist
            $check = $this->resiModel->checkDuplicate($resi);
            // exist
            if ($check == 1) {
              // check status
              $checkStatus = $this->resiModel->checkStatus($resi, $status);
              // previous status filled
              if ($checkStatus == 'ok') {
                $value[] = [
                  'no_resi' => $resi,
                  'status_id' => 5,
                  'closed_at' => time()
                ];
              } else {
                session()->setFlashdata('skipped', $resi);
                return redirect()->to('/admin')->withInput();
              }
            } else {
              session()->setFlashdata('skipped', $resi);
              return redirect()->to('/admin')->withInput();
            }
            break;
          default:
            // check unique
            $check = $this->resiModel->checkDuplicate($resi);
            if ($check == 1) {
              session()->setFlashdata('duplicate', $resi);
              return redirect()->to('/admin')->withInput();
            } else {
              // unique
              $value[] = [
                'no_resi' => $resi,
                'status_id' => 1,
                'warehouse_at' => time()
              ];
            }
            break;
        }
      }
      switch ($status) {
        case 1:
          $db->table('resi')->insertBatch($value);
          break;
        default:
          $db->table('resi')->updateBatch($value, 'no_resi');
          break;
      }
      session()->setFlashdata('info', 'success');
      return redirect()->to('/admin')->withInput();
    }
  }
  public function manual()
  {
    if (session()->get('login') != true) {
      return redirect()->to('/');
    }
    if (!$this->validate(
      [
        'manual' => [
          'label' => 'Inputan Manual',
          'rules' => 'required',
          'errors' => [
            'required' => '{field} wajib diisi',
          ]
        ]
      ]
    )) {
      return redirect()->to('/admin')->withInput();
    } else {
      $this->resiModel = new ResiModel();
      $db = \Config\Database::connect();
      $manual = explode(PHP_EOL, htmlspecialchars($this->request->getVar('manual')));
      $status = htmlspecialchars($this->request->getVar('statusManual'));
      foreach ($manual as $resi) {
        switch ($status) {
          case 1:
            // check unique
            $check = $this->resiModel->checkDuplicate($resi);
            if ($check == 1) {
              session()->setFlashdata('duplicate', $resi);
              return redirect()->to('/admin')->withInput();
            } else {
              // unique
              $value[] = [
                'no_resi' => $resi,
                'status_id' => 1,
                'warehouse_at' => time()
              ];
            }
            break;
          case 2:
            // check exist
            $check = $this->resiModel->checkDuplicate($resi);
            // exist
            if ($check == 1) {
              // check status
              $checkStatus = $this->resiModel->checkStatus($resi, $status);
              // previous status filled
              if ($checkStatus == 'ok') {
                $value[] = [
                  'no_resi' => $resi,
                  'status_id' => 2,
                  'eta_at' => time()
                ];
              } else {
                session()->setFlashdata('skipped', $resi);
                return redirect()->to('/admin')->withInput();
              }
            } else {
              session()->setFlashdata('skipped', $resi);
              return redirect()->to('/admin')->withInput();
            }
            break;
          case 3:
            // check exist
            $check = $this->resiModel->checkDuplicate($resi);
            // exist
            if ($check == 1) {
              // check status
              $checkStatus = $this->resiModel->checkStatus($resi, $status);
              // previous status filled
              if ($checkStatus == 'ok') {
                $value[] = [
                  'no_resi' => $resi,
                  'status_id' => 3,
                  'process_at' => time()
                ];
              } else {
                session()->setFlashdata('skipped', $resi);
                return redirect()->to('/admin')->withInput();
              }
            } else {
              session()->setFlashdata('skipped', $resi);
              return redirect()->to('/admin')->withInput();
            }
            break;
          case 4:
            // check exist
            $check = $this->resiModel->checkDuplicate($resi);
            // exist
            if ($check == 1) {
              // check status
              $checkStatus = $this->resiModel->checkStatus($resi, $status);
              // previous status filled
              if ($checkStatus == 'ok') {
                $value[] = [
                  'no_resi' => $resi,
                  'status_id' => 4,
                  'delivery_at' => time()
                ];
              } else {
                session()->setFlashdata('skipped', $resi);
                return redirect()->to('/admin')->withInput();
              }
            } else {
              session()->setFlashdata('skipped', $resi);
              return redirect()->to('/admin')->withInput();
            }
            break;
          case 5:
            // check exist
            $check = $this->resiModel->checkDuplicate($resi);
            // exist
            if ($check == 1) {
              // check status
              $checkStatus = $this->resiModel->checkStatus($resi, $status);
              // previous status filled
              if ($checkStatus == 'ok') {
                $value[] = [
                  'no_resi' => $resi,
                  'status_id' => 5,
                  'closed_at' => time()
                ];
              } else {
                session()->setFlashdata('skipped', $resi);
                return redirect()->to('/admin')->withInput();
              }
            } else {
              session()->setFlashdata('skipped', $resi);
              return redirect()->to('/admin')->withInput();
            }
            break;
          default:
            // check unique
            $check = $this->resiModel->checkDuplicate($resi);
            if ($check == 1) {
              session()->setFlashdata('duplicate', $resi);
              return redirect()->to('/admin')->withInput();
            } else {
              // unique
              $value[] = [
                'no_resi' => $resi,
                'status_id' => 1,
                'warehouse_at' => time()
              ];
            }
            break;
        }
      }
      switch ($status) {
        case 1:
          $db->table('resi')->insertBatch($value);
          break;
        default:
          $db->table('resi')->updateBatch($value, 'no_resi');
          break;
      }
      session()->setFlashdata('info', 'success');
      return redirect()->to('/admin')->withInput();
    }
  }
  public function update()
  {
    if (session()->get('login') != true) {
      return redirect()->to('/');
    }
    if (!$this->validate([
      'resi' => [
        'label' => 'Nomor Resi',
        'rules' => 'required',
        'errors' => [
          'required' => '{field} wajib diisi'
        ]
      ]
    ])) {
      return redirect()->to('/admin')->withInput();
    } else {
      $resi = htmlspecialchars($this->request->getVar('resi'));
      $id = $this->request->getVar('idResi');
      $this->resiModel = new ResiModel();
      $this->resiModel->update($id, ['no_resi' => $resi]);
      session()->setFlashdata('info', 'success');
      return redirect()->to('/admin');
    }
  }
  public function getResi()
  {
    if (session()->get('login') != true) {
      return redirect()->to('/');
    }
    $db = \Config\Database::connect();
    $id = $this->request->getVar('id');
    $data = $db->table('resi')->select('resi.id, resi.no_resi, status.status')->join('status', 'status.id = resi.status_id')->where('resi.id', $id)->get()->getRowArray();
    return json_encode($data);
  }
  public function delete($id)
  {
    if (session()->get('login') != true) {
      return redirect()->to('/');
    }
    $this->resiModel = new ResiModel();
    $this->resiModel->delete($id);
    session()->setFlashdata('info', 'success');
    return redirect()->to('/admin');
  }
}
