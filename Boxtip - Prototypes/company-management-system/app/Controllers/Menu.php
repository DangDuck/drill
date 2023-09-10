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

class Menu extends BaseController
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

  public function index()
  {
    // kalau id rolenya bukan 2
    if (session()->get('id_role') != 2) {
      if (session()->get('id_role') == 1) {
        return redirect()->to('/master');
      } else {
        return redirect()->to('/home');
      }
    }

    $data = [
      'title' => 'Home',
    ];

    return view('menu/index', $data);
  }

  public function pesanan()
  {
    // kalau id rolenya bukan 2
    if (session()->get('id_role') != 2) {
      if (session()->get('id_role') == 1) {
        return redirect()->to('/master');
      } else {
        return redirect()->to('/home');
      }
    }

    $data = [
      'title' => 'Pesanan',
      'invoice' => $this->invoiceModel->getInvoiceByCustomer(session()->get('id_customer')),
    ];

    return view('pesanan/index', $data);
  }

  public function resi($nomor_invoice)
  {
    // kalau id rolenya bukan 2
    if (session()->get('id_role') != 2) {
      if (session()->get('id_role') == 1) {
        return redirect()->to('/master');
      } else {
        return redirect()->to('/home');
      }
    }

    $data = [
      'title' => 'Resi Pesanan',
      'nomor_invoice' => $nomor_invoice,
      'resi' => $this->resiModel->getAllResiByInvoice($nomor_invoice),
    ];

    return view('pesanan/resi', $data);
  }

  public function cekresi($nomor_resi)
  {
    // kalau id rolenya bukan 2
    if (session()->get('id_role') != 2) {
      if (session()->get('id_role') == 1) {
        return redirect()->to('/master');
      } else {
        return redirect()->to('/home');
      }
    }

    $data = [
      'title' => 'Cek Resi',
      'resi' => $this->resiModel->getDataResiForDetail($nomor_resi),
      'status' => $this->statusResiModel->getAllStatus()
    ];

    return view('pesanan/cekresi', $data);
  }

  public function view($file_path)
  {
    // kalau id rolenya bukan 2
    if (session()->get('id_role') != 2) {
      if (session()->get('id_role') == 1) {
        return redirect()->to('/master');
      } else {
        return redirect()->to('/home');
      }
    }

    // The location of the PDF file 
    // on the server 
    $filename = "/invoice" . '/' . $file_path;

    // Header content type 
    header("Content-type: application/pdf");

    header("Content-Length: " . filesize($filename));

    // Send the file to the browser. 
    readfile($filename);
  }
}
