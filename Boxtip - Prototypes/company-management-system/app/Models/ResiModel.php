<?php

namespace App\Models;

use CodeIgniter\Model;

class ResiModel extends Model
{
  protected $table = 'resi';
  protected $useTimestamps = true;
  protected $primaryKey = 'nomor_resi';
  protected $allowedFields = ['nomor_resi', 'nomor_resi_boxtip', 'nomor_invoice', 'id_resi_status'];

  public function getAllResi()
  {
    return $this->db->query('SELECT resi.nomor_resi AS nomor_resi, resi.nomor_resi_boxtip AS nomor_resi_boxtip, resi.nomor_invoice AS nomor_invoice, resi.id_resi_status AS id_status, status_resi.status AS status FROM resi JOIN status_resi ON resi.id_resi_status = status_resi.id')->getResultArray();
  }

  public function getAllResiByInvoice($nomor_invoice)
  {
    return $this->db->query("SELECT resi.nomor_resi_boxtip AS nomor_resi_boxtip,
    resi.id_resi_status AS id_status,
    resi.updated_at AS updated_at, 
    resi.created_at AS created_at, 
    status_resi.status AS status
    FROM resi 
    JOIN status_resi 
    ON resi.id_resi_status = status_resi.id 
    WHERE nomor_invoice = '$nomor_invoice'")->getResultArray();
  }

  public function getDataResi($nomor_resi)
  {
    return $this->db->query("SELECT resi.nomor_resi AS nomor_resi, resi.nomor_resi_boxtip AS nomor_resi_boxtip, resi.nomor_invoice AS nomor_invoice, resi.id_resi_status AS id_status, status_resi.status AS status FROM resi JOIN status_resi ON resi.id_resi_status = status_resi.id WHERE resi.nomor_resi LIKE '$nomor_resi'")->getRowArray();
  }

  public function getDataResiForDetail($nomor_resi)
  {
    return $this->db->query("SELECT resi.nomor_resi_boxtip AS nomor_resi,
    resi.nomor_invoice AS nomor_invoice,
    resi.id_resi_status AS id_status,
    resi.updated_at AS updated_at,
    resi.created_at AS created_at,
    status_resi.status AS status
    FROM resi
    JOIN status_resi 
    ON resi.id_resi_status = status_resi.id
    WHERE resi.nomor_resi_boxtip LIKE '$nomor_resi'")->getRowArray();
  }
}
