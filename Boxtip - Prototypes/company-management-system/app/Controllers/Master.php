<?php

namespace App\Controllers;

// model
use App\Models\DataModel;
use App\Models\CustomerModel;
use App\Models\InvoiceModel;
use App\Models\StatusPembayaranModel;
use App\Models\StatusResiModel;
use App\Models\UserModel;
use App\Models\ResiModel;

class Master extends BaseController
{
  protected $dataModel;
  protected $invoiceModel;
  protected $statusPembayaranModel;
  protected $statusResiModel;
  protected $customerModel;
  protected $userModel;
  protected $resiModel;

  // constructor
  public function __construct()
  {
    $this->dataModel = new DataModel();
    $this->invoiceModel = new InvoiceModel();
    $this->statusPembayaranModel = new StatusPembayaranModel();
    $this->statusResiModel = new StatusResiModel();
    $this->customerModel = new CustomerModel();
    $this->userModel = new UserModel();
    $this->resiModel = new ResiModel();
  }

  //------------------------------------------------------------------------------
  // INVOICE
  public function index()
  {
    // kalau id rolenya bukan 1
    if (session()->get('id_role') != 1) {
      if (session()->get('id_role') == 2) {
        return redirect()->to('/menu');
      } else {
        return redirect()->to('/home');
      }
    }

    $data = [
      'title' => 'Invoice',
      'invoice' => $this->invoiceModel->getAllInvoices(),
      'status'  => $this->statusPembayaranModel->getAllStatus(),
      'customer_code' => $this->customerModel->getAllCustomerCode(),
      'validation' => \Config\Services::validation(),
    ];
    return view('master/index', $data);
  }

  // generate nomor invoice
  private function generateInvoice($customerCode)
  {
    date_default_timezone_set("Asia/Jakarta");

    // ambil last invoice & diproses
    $last_inv = $this->invoiceModel->getLastInvoice();
    $last_no = $last_inv['nomor_invoice'];
    $splitInv = explode('-', $last_no);
    $date = explode('INV', $splitInv[0]);
    $date = date_create_from_format('Ymd', $date[1]);
    // output berupa tanggal invoice terakhir
    $date = $date->format('Ymd');

    if (date('Ymd') > $date) {
      // kalau tanggalnya sudah ganti
      return "INV" . date('Ymd') . "-" . $customerCode . "-" . "001";
    } else {
      // kalau masih tanggal yang sama
      $no = (int)$splitInv[2] + 1;
      $no = str_pad($no, 3, "0", STR_PAD_LEFT);
      return "INV" . $date . "-" . $customerCode . "-" . $no;
    }
  }

  // UPLOAD INVOICE DENGAN NOMOR INVOICE MANUAL
  public function uploadInvoice()
  {
    // kalau id rolenya bukan 1
    if (session()->get('id_role') != 1) {
      if (session()->get('id_role') == 2) {
        return redirect()->to('/menu');
      } else {
        return redirect()->to('/home');
      }
    }
    // invalid
    if (!$this->validate([
      'nomorInvoice' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Nomor Invoice tidak diinput'
        ]
      ],
      'customerCode' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Customer Code tidak dipilih'
        ]
      ],
      'paymentStatus' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Payment Status tidak dipilih'
        ]
      ],
      'invoiceFile' => [
        'rules' => 'uploaded[invoiceFile]|ext_in[invoiceFile,pdf]|mime_in[invoiceFile,application/pdf]|max_size[invoiceFile,2048]',
        'errors' => [
          'uploaded' => 'File Invoice tidak dipilih',
          'ext_in' => 'Format file yang diupload tidak benar',
          'mime_in' => 'Format file yang diupload tidak benar',
          'max_size' => 'Ukuran file yang diupload melebihi 2MB'
        ]
      ]
    ])) {
      return redirect()->to('/master')->withInput();
    }

    date_default_timezone_set("Asia/Jakarta");
    // valid
    // file invoice
    $fileInvoice = $this->request->getFile('invoiceFile');
    if ($fileInvoice->getError() == 4) {
      session()->setFlashdata('info', 'upload_error');
      return redirect()->to('/master');
    } else {
      // nama invoice
      $namaInvoice = $fileInvoice->getRandomName();

      // pindah file_path
      $fileInvoice->move('invoice', $namaInvoice);
    }

    // ambil data
    $cust = $this->request->getVar('customerCode');
    $cust_id = explode('-', $cust)[0];

    // insert
    $this->invoiceModel->insert(
      [
        'nomor_invoice' => $this->request->getVar('nomorInvoice'),
        'id_customer' => $cust_id,
        'payment_date' => date('Y-m-d h:i:s', time()),
        'id_payment_status' => $this->request->getVar('paymentStatus'),
        'file_path' => $namaInvoice
      ]
    );
    session()->setFlashdata('info', 'success-add');
    return redirect()->to('/master');
  }

  // UPDATE INVOICE
  public function update()
  {
    // kalau id rolenya bukan 1
    if (session()->get('id_role') != 1) {
      if (session()->get('id_role') == 2) {
        return redirect()->to('/menu');
      } else {
        return redirect()->to('/home');
      }
    }

    $nomor_invoice = $this->request->getVar('id');
    $dataInvoice = $this->invoiceModel->getDataInvoice($nomor_invoice);
    echo json_encode($dataInvoice);
  }

  public function edit()
  {
    // kalau id rolenya bukan 1
    if (session()->get('id_role') != 1) {
      if (session()->get('id_role') == 2) {
        return redirect()->to('/menu');
      } else {
        return redirect()->to('/home');
      }
    }
    // invalid
    if (!$this->validate([
      'nomorInvoice' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Nomor Invoice tidak diinput'
        ]
      ],
      'customerCode' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Customer Code tidak dipilih'
        ]
      ],
      'paymentStatus' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Payment Status tidak dipilih'
        ]
      ],
      'invoiceFile' => [
        'rules' => 'ext_in[invoiceFile,pdf]|mime_in[invoiceFile,application/pdf]|max_size[invoiceFile,2048]',
        'errors' => [
          'ext_in' => 'Format file yang diupload tidak benar',
          'mime_in' => 'Format file yang diupload tidak benar',
          'max_size' => 'Ukuran file yang diupload melebihi 2MB'
        ]
      ]
    ])) {
      return redirect()->to('/master')->withInput();
    }

    // valid
    // ambil data
    $nomor_invoice = $this->request->getVar('nomorInvoice');
    $nomor_invoice_lama = $this->request->getVar('nomorInvoiceLama');
    $cust = $this->request->getVar('customerCode');
    $cust_id = explode('-', $cust)[0];

    // file invoice
    $fileInvoice = $this->request->getFile('invoiceFile');
    // if file not change
    if ($fileInvoice->getError() == 4) {
      $this->invoiceModel->update($nomor_invoice_lama, [
        'nomor_invoice' => $nomor_invoice,
        'id_customer' => $cust_id,
        'id_payment_status' => $this->request->getVar('paymentStatus')
      ]);
    } else {
      // file changed
      $filePathLama = $this->invoiceModel->getDataInvoice($nomor_invoice_lama);
      // nama invoice
      $namaInvoice = $fileInvoice->getRandomName();
      // pindah file_path
      $fileInvoice->move('invoice', $namaInvoice);
      // delete file lama
      unlink('invoice' . '/' . $filePathLama['file_path']);

      $this->invoiceModel->update($nomor_invoice_lama, [
        'nomor_invoice' => $nomor_invoice,
        'id_customer' => $cust_id,
        'id_payment_status' => $this->request->getVar('paymentStatus'),
        'file_path' => $namaInvoice
      ]);
    }
    session()->setFlashdata('info', 'success-edit');
    return redirect()->to('/master');
  }

  public function deleteinvoice($nomor_invoice)
  {
    // kalau id rolenya bukan 1
    if (session()->get('id_role') != 1) {
      if (session()->get('id_role') == 2) {
        return redirect()->to('/menu');
      } else {
        return redirect()->to('/home');
      }
    }

    $dataInvoice = $this->invoiceModel->getDataInvoice($nomor_invoice);
    unlink('invoice' . '/' . $dataInvoice['file_path']);

    $this->invoiceModel->delete($nomor_invoice);
    session()->setFlashdata('info', 'success-delete');
    return redirect()->to('/master');
  }
  //------------------------------------------------------------------------------
  // END OF INVOICE

  //------------------------------------------------------------------------------
  // RESI
  public function resi()
  {
    // kalau id rolenya bukan 1
    if (session()->get('id_role') != 1) {
      if (session()->get('id_role') == 2) {
        return redirect()->to('/menu');
      } else {
        return redirect()->to('/home');
      }
    }

    $data = [
      'title' => 'Resi',
      'validation' => \Config\Services::validation(),
      'resi' => $this->resiModel->getAllResi(),
      'invoice' => $this->invoiceModel->getAllInvoices(),
      'status' => $this->statusResiModel->getAllStatus()
    ];

    return view('resi/index', $data);
  }

  // GENERATE NOMOR RESI BOXTIP
  private function genResi()
  {
    $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWYZ';
    return substr(str_shuffle($permitted_chars), 0, 20);
  }


  // ADD RESI
  public function addResi()
  {
    // kalau id rolenya bukan 1
    if (session()->get('id_role') != 1) {
      if (session()->get('id_role') == 2) {
        return redirect()->to('/menu');
      } else {
        return redirect()->to('/home');
      }
    }

    // invalid
    if (!$this->validate([
      'nomor_resi' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Nomor Resi tidak diisi'
        ]
      ],
      'nomor_invoice' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Nomor Invoice tidak dipilih'
        ]
      ],
      'status' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Status Resi tidak dipilih'
        ]
      ],
    ])) {
      return redirect()->to('/master/resi')->withInput();
    }

    // valid
    // ambil data
    $nomor_resi = $this->request->getVar('nomor_resi');
    $nomor_invoice = $this->request->getVar('nomor_invoice');
    $id_resi_status = $this->request->getVar('status');
    $nomor_resi_boxtip = $this->genResi();

    $this->resiModel->insert([
      'nomor_resi' => $nomor_resi,
      'nomor_resi_boxtip' => $nomor_resi_boxtip,
      'nomor_invoice' => $nomor_invoice,
      'id_resi_status' =>  $id_resi_status,
    ]);

    session()->setFlashdata('info', 'success-add');
    return redirect()->to('/master/resi');
  }

  public function updateResi()
  {
    // kalau id rolenya bukan 1
    if (session()->get('id_role') != 1) {
      if (session()->get('id_role') == 2) {
        return redirect()->to('/menu');
      } else {
        return redirect()->to('/home');
      }
    }

    $nomor_resi = $this->request->getVar('id');;
    $dataResi = $this->resiModel->getDataResi($nomor_resi);
    echo json_encode($dataResi);
  }

  public function editResi()
  {
    // kalau id rolenya bukan 1
    if (session()->get('id_role') != 1) {
      if (session()->get('id_role') == 2) {
        return redirect()->to('/menu');
      } else {
        return redirect()->to('/home');
      }
    }

    // invalid
    if (!$this->validate([
      'nomor_invoice' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Nomor Invoice tidak dipilih'
        ]
      ],
      'status' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Status Resi tidak dipilih'
        ]
      ],
    ])) {
      return redirect()->to('/master/resi')->withInput();
    }

    // valid
    // ambil data
    $nomor_resi = $this->request->getVar('input_nomor_resi');
    $nomor_invoice = $this->request->getVar('nomor_invoice');
    $status = $this->request->getVar('status');

    // update
    $this->resiModel->update($nomor_resi, [
      'nomor_invoice' => $nomor_invoice,
      'id_resi_status' => $status
    ]);

    session()->setFlashdata('info', 'success-edit');
    return redirect()->to('/master/resi');
  }

  public function deleteResi($nomor_resi)
  {
    // kalau id rolenya bukan 1
    if (session()->get('id_role') != 1) {
      if (session()->get('id_role') == 2) {
        return redirect()->to('/menu');
      } else {
        return redirect()->to('/home');
      }
    }

    $this->resiModel->delete($nomor_resi);
    session()->setFlashdata('info', 'success-delete');
    return redirect()->to('/master/resi');
  }

  //------------------------------------------------------------------------------
  // END OF RESI

  //------------------------------------------------------------------------------
  // CUSTOMER
  public function customer()
  {
    // kalau id rolenya bukan 1
    if (session()->get('id_role') != 1) {
      if (session()->get('id_role') == 2) {
        return redirect()->to('/menu');
      } else {
        return redirect()->to('/home');
      }
    }

    $data = [
      'title' => 'Customer',
      'customer' => $this->customerModel->getCustomer(),
      'validation' => \Config\Services::validation()
    ];
    return view('customer/index', $data);
  }

  // GENERATE CUSTOMER CODE
  private function genCustomer()
  {
    $lastCustomer = $this->customerModel->getLastCustomer()['customer_code'];
    $genCustCode = explode('BX', $lastCustomer)[1] + 1;
    $genCustCode = 'BX' . str_pad($genCustCode, 3, "0", STR_PAD_LEFT);

    return $genCustCode;
  }

  // ADD CUSTOMER
  public function addCustomer()
  {
    // kalau id rolenya bukan 1
    if (session()->get('id_role') != 1) {
      if (session()->get('id_role') == 2) {
        return redirect()->to('/menu');
      } else {
        return redirect()->to('/home');
      }
    }

    // invalid
    if (!$this->validate([
      'customerName' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Nama customer wajib diisi'
        ]
      ],
      'nomor_telpon' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Nomor Telpon wajib diisi'
        ]
      ],
      'alamat' => [
        'rules' => 'required',
        'erros' => [
          'required' => 'Alamat wajib diisi'
        ]
      ]
    ])) {
      return redirect()->to('/master/customer')->withInput();
    };

    // valid
    // ambil data
    $nama = $this->request->getVar('customerName');
    $nomor_telpon = $this->request->getVar('nomor_telpon');
    $alamat = $this->request->getVar('alamat');
    $instagram = $this->request->getVar('instagram');
    $cust_code = $this->genCustomer();

    // insert data
    $this->customerModel->insert(
      [
        'customer_code' => $cust_code,
        'nama' => $nama,
        'nomor_telpon' => $nomor_telpon,
        'alamat' => $alamat,
        'instagram' => ($instagram == '' || $instagram == 'tidak diketahui') ? 'tidak diketahui' : $instagram,
      ]
    );

    session()->setFlashdata('info', 'success-add');
    return redirect()->to('/master/customer');
  }

  // EDIT CUSTOMER
  public function updateCustomer()
  {
    // kalau id rolenya bukan 1
    if (session()->get('id_role') != 1) {
      if (session()->get('id_role') == 2) {
        return redirect()->to('/menu');
      } else {
        return redirect()->to('/home');
      }
    }

    $id_customer = $this->request->getVar('id');
    $dataCustomer = $this->customerModel->getDataCustomer($id_customer);
    echo json_encode($dataCustomer);
  }

  public function editCustomer()
  {
    // kalau id rolenya bukan 1
    if (session()->get('id_role') != 1) {
      if (session()->get('id_role') == 2) {
        return redirect()->to('/menu');
      } else {
        return redirect()->to('/home');
      }
    }

    // invalid
    if (!$this->validate([
      'customerName' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Nama customer wajib diisi'
        ]
      ],
      'nomor_telpon' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Nomor Telpon wajib diisi'
        ]
      ],
      'alamat' => [
        'rules' => 'required',
        'erros' => [
          'required' => 'Alamat wajib diisi'
        ]
      ]
    ])) {
      return redirect()->to('/master/customer')->withInput();
    };

    // valid
    // ambil data
    $nama = $this->request->getVar('customerName');
    $nomor_telpon = $this->request->getVar('nomor_telpon');
    $alamat = $this->request->getVar('alamat');
    $instagram = $this->request->getVar('instagram');
    $id = $this->request->getVar('id_customer');

    // update data
    $this->customerModel->save(
      [
        'id' => $id,
        'nama' => $nama,
        'nomor_telpon' => $nomor_telpon,
        'alamat' => $alamat,
        'instagram' => ($instagram == '' || $instagram == 'tidak diketahui') ? 'tidak diketahui' : $instagram,
      ]
    );

    session()->setFlashdata('info', 'success-edit');
    return redirect()->to('/master/customer');
  }

  // DELETE CUSTOMER
  public function deletecustomer($id_customer)
  {
    // kalau id rolenya bukan 1
    if (session()->get('id_role') != 1) {
      if (session()->get('id_role') == 2) {
        return redirect()->to('/menu');
      } else {
        return redirect()->to('/home');
      }
    }

    $this->customerModel->delete($id_customer);
    session()->setFlashdata('info', 'success-delete');
    return redirect()->to('/master/customer');
  }
  //------------------------------------------------------------------------------
  // END OF CUSTOMER

  //------------------------------------------------------------------------------
  // USER
  public function user()
  {
    // kalau id rolenya bukan 1
    if (session()->get('id_role') != 1) {
      if (session()->get('id_role') == 2) {
        return redirect()->to('/menu');
      } else {
        return redirect()->to('/home');
      }
    }

    $data = [
      'title' => 'user',
      'validation' => \Config\Services::validation(),
      'user' => $this->userModel->getAllUser()
    ];

    return view('user/index', $data);
  }

  // ADD USER
  public function adduser($customer_code)
  {
    // kalau id rolenya bukan 1
    if (session()->get('id_role') != 1) {
      if (session()->get('id_role') == 2) {
        return redirect()->to('/menu');
      } else {
        return redirect()->to('/home');
      }
    }

    $data = [
      'title' => 'user',
      'customer_code' => $customer_code,
      'validation' => \Config\Services::validation(),
    ];

    return view('user/add', $data);
  }

  // CREATE USER
  public function createUser()
  {
    // kalau id rolenya bukan 1
    if (session()->get('id_role') != 1) {
      if (session()->get('id_role') == 2) {
        return redirect()->to('/menu');
      } else {
        return redirect()->to('/home');
      }
    }

    $username = $this->request->getVar('username');
    $id_customer = $this->customerModel->getDataByCustomerCode($username);
    if (!$this->validate([
      'password' => [
        'rules' => 'required|min_length[8]',
        'errors' => [
          'required' => 'Password wajib diisi',
          'min_length' => 'Panjang minimal password 8 digit'
        ]
      ]
    ])) {
      return redirect()->to('/master/adduser' . '/' . $username)->withInput();
    }

    // ambil data
    $password = $this->request->getVar('password');

    // insert
    $this->userModel->insert([
      'username' => $username,
      'password' => password_hash($password, PASSWORD_DEFAULT),
      'id_role' => 2,
      'id_customer' => $id_customer['id']
    ]);

    session()->setFlashdata('info', 'success-create');
    return redirect()->to('/master/user');
  }

  // RESET PASSWORD
  public function resetpassword($username)
  {
    // kalau id rolenya bukan 1
    if (session()->get('id_role') != 1) {
      if (session()->get('id_role') == 2) {
        return redirect()->to('/menu');
      } else {
        return redirect()->to('/home');
      }
    }

    $data = [
      'title' => 'user',
      'customer_code' => $username,
      'validation' => \Config\Services::validation(),
    ];

    return view('user/reset', $data);
  }

  // SUBMIT PASSWORD
  public function submitPassword()
  {
    // kalau id rolenya bukan 1
    if (session()->get('id_role') != 1) {
      if (session()->get('id_role') == 2) {
        return redirect()->to('/menu');
      } else {
        return redirect()->to('/home');
      }
    }

    $username = $this->request->getVar('username');
    if (!$this->validate([
      'password' => [
        'rules' => 'required|min_length[8]',
        'errors' => [
          'required' => 'Password wajib diisi',
          'min_length' => 'Panjang minimal password 8 digit'
        ]
      ]
    ])) {
      return redirect()->to('/master/resetpassword' . '/' . $username)->withInput();
    }

    // ambil data
    $password = $this->request->getVar('password');

    // update
    $this->userModel->update($username, [
      'password' => password_hash($password, PASSWORD_DEFAULT),
    ]);

    session()->setFlashdata('info', 'success-edit');
    return redirect()->to('/master/user');
  }

  // DELETE USER
  public function deleteUser($username)
  {
    // kalau id rolenya bukan 1
    if (session()->get('id_role') != 1) {
      if (session()->get('id_role') == 2) {
        return redirect()->to('/menu');
      } else {
        return redirect()->to('/home');
      }
    }

    $this->userModel->delete($username);
    session()->setFlashdata('info', 'success-delete');
    return redirect()->to('/master/user');
  }

  //------------------------------------------------------------------------------
  // END OF USER

  // ---------------------------------------------------------------------------
  // Function yang tidak dipakai

  // UPLOAD INVOICE DENGAN NOMOR INVOICE AUTOGENERATE
  public function uploadInvoiceAutoGenerate()
  {
    // kalau id rolenya bukan 1
    if (session()->get('id_role') != 1) {
      if (session()->get('id_role') == 2) {
        return redirect()->to('/menu');
      } else {
        return redirect()->to('/home');
      }
    }
    // invalid
    if (!$this->validate([
      'customerCode' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Customer Code tidak dipilih'
        ]
      ],
      'paymentStatus' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Payment Status tidak dipilih'
        ]
      ],
      'invoiceFile' => [
        'rules' => 'uploaded[invoiceFile]|ext_in[invoiceFile,pdf]|mime_in[invoiceFile,application/pdf]|max_size[invoiceFile,2048]',
        'errors' => [
          'uploaded' => 'File Invoice tidak dipilih',
          'ext_in' => 'Format file yang diupload tidak benar',
          'mime_in' => 'Format file yang diupload tidak benar',
          'max_size' => 'Ukuran file yang diupload melebihi 2MB'
        ]
      ]
    ])) {
      return redirect()->to('/master')->withInput();
    }

    // valid
    // file invoice
    $fileInvoice = $this->request->getFile('invoiceFile');
    if ($fileInvoice->getError() == 4) {
      session()->setFlashdata('info', 'upload_error');
      return redirect()->to('/master');
    } else {
      // nama invoice
      $namaInvoice = $fileInvoice->getRandomName();

      // pindah file_path
      $fileInvoice->move('invoice', $namaInvoice);
    }

    // ambil data
    $cust = $this->request->getVar('customerCode');
    $cust_id = explode('-', $cust)[0];
    $cust_code = explode('-', $cust)[1];
    // insert
    $this->invoiceModel->insert(
      [
        'nomor_invoice' => $this->generateInvoice($cust_code),
        'id_customer' => $cust_id,
        'payment_date' => date('Y-m-d h:i:s', time()),
        'id_payment_status' => $this->request->getVar('paymentStatus'),
        'file_path' => $namaInvoice
      ]
    );
    session()->setFlashdata('info', 'success-add');
    return redirect()->to('/master');
  }


  // function edit dengan autogenerate nomor invoice
  public function editAutoGenerate()
  {
    // kalau id rolenya bukan 1
    if (session()->get('id_role') != 1) {
      if (session()->get('id_role') == 2) {
        return redirect()->to('/menu');
      } else {
        return redirect()->to('/home');
      }
    }
    // invalid
    if (!$this->validate([
      'nomorInvoice' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Nomor Invoice tidak diinput'
        ]
      ],
      'customerCode' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Customer Code tidak dipilih'
        ]
      ],
      'paymentStatus' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Payment Status tidak dipilih'
        ]
      ],
      'invoiceFile' => [
        'rules' => 'ext_in[invoiceFile,pdf]|mime_in[invoiceFile,application/pdf]|max_size[invoiceFile,2048]',
        'errors' => [
          'ext_in' => 'Format file yang diupload tidak benar',
          'mime_in' => 'Format file yang diupload tidak benar',
          'max_size' => 'Ukuran file yang diupload melebihi 2MB'
        ]
      ]
    ])) {
      return redirect()->to('/master')->withInput();
    }

    // valid
    // ambil data
    $nomor_invoice = $this->request->getVar('nomorInvoice');
    $new_nomor_invoice = '';
    $cust = $this->request->getVar('customerCode');
    $cust_id = explode('-', $cust)[0];
    $cust_code = explode('-', $cust)[1];

    // customer
    if ($cust_code == explode('-', $nomor_invoice)[1]) {

      // customer not changed
      $new_nomor_invoice = $nomor_invoice;
    } else {
      // customer changed
      $new_nomor_invoice = explode('-', $nomor_invoice)[0] . '-' . $cust_code . '-' . explode('-', $nomor_invoice)[2];
    }

    // file invoice
    $fileInvoice = $this->request->getFile('invoiceFile');
    // if file not change
    if ($fileInvoice->getError() == 4) {
      $this->invoiceModel->update($nomor_invoice, [
        'nomor_invoice' => $new_nomor_invoice,
        'id_customer' => $cust_id,
        'id_payment_status' => $this->request->getVar('paymentStatus')
      ]);
    } else {
      // file changed
      $filePathLama = $this->invoiceModel->getDataInvoice($nomor_invoice);
      // nama invoice
      $namaInvoice = $fileInvoice->getRandomName();
      // pindah file_path
      $fileInvoice->move('invoice', $namaInvoice);
      // delete file lama
      unlink('invoice' . '/' . $filePathLama['file_path']);

      $this->invoiceModel->update($nomor_invoice, [
        'nomor_invoice' => $new_nomor_invoice,
        'id_customer' => $cust_id,
        'id_payment_status' => $this->request->getVar('paymentStatus'),
        'file_path' => $namaInvoice
      ]);
    }
    session()->setFlashdata('info', 'success-edit');
    return redirect()->to('/master');
  }
}
