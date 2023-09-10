<?php

namespace App\Models;

use CodeIgniter\Model;

class InvoiceModel extends Model
{
  protected $table = 'invoice';
  protected $allowedFields = ['nomor_invoice', 'id_customer', 'payment_date', 'id_payment_status', 'file_path'];
  protected $useTimestamps = true;
  protected $primaryKey = 'nomor_invoice';

  public function getAllInvoices()
  {
    $query = $this->db->query("SELECT invoice.nomor_invoice AS nomor_invoice, customer.customer_code AS customer_code,
    invoice.updated_at AS updated_at, 
    status_pembayaran.status AS status,
    invoice.file_path AS file_path
    FROM invoice
    JOIN customer
    ON invoice.id_customer = customer.id
    JOIN status_pembayaran
    ON invoice.id_payment_status = status_pembayaran.id")->getResultArray();
    return $query;
  }

  public function getLastInvoice()
  {
    return $this->db->query(
      "SELECT *
      FROM invoice
      ORDER BY payment_date DESC LIMIT 1"
    )->getRowArray();
  }

  public function getDataInvoice($nomor_invoice)
  {
    // harus ada customer_code, id_customer, id_payment_status, file_path, 
    return $this->db->query("SELECT invoice.nomor_invoice AS nomor_invoice, invoice.id_customer AS id_customer, customer.customer_code AS customer_code, invoice.id_payment_status AS id_payment_status, invoice.file_path AS file_path FROM invoice JOIN customer ON invoice.id_customer = customer.id WHERE nomor_invoice = '$nomor_invoice'")->getRowArray();
  }

  public function getInvoiceByCustomer($id_customer)
  {
    return $this->db->query("SELECT invoice.nomor_invoice AS nomor_invoice,
    invoice.payment_date AS payment_date,
    invoice.updated_at AS updated_at,
    status_pembayaran.status AS status,
    invoice.file_path AS file_path
    FROM invoice
    JOIN status_pembayaran
    ON invoice.id_payment_status = status_pembayaran.id WHERE id_customer = $id_customer")->getResultArray();
  }
}
