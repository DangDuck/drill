<?= $this->extend('layout/table'); ?>
<?= $this->section('content'); ?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800 font-weight-bold text-uppercase">Daftar Pesanan</h1>
<div class="row mb-4">
  <div class="col-lg-8 ">
    <p>
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora, quaerat sunt. Vitae illum esse, est ratione eveniet necessitatibus officiis hic numquam eius exercitationem fugiat atque, aperiam iusto, ex omnis veritatis.
    </p>
  </div>
  <div class="col-lg-4">
    <div class="row">
      <div class="col-3 font-weight-bold text-gray-800">
        Code
      </div>
      <div class="col-9 font-weight-bold text-gray-800">
        <?= ": " . session()->get('customer_code') ?>
      </div>
    </div>
    <div class="row">
      <div class="col-3 font-weight-bold text-gray-800">
        Name
      </div>
      <div class="col-9 font-weight-bold text-gray-800">
        <?= ": " . session()->get('nama') ?>
      </div>
    </div>
  </div>
</div>

<!-- DataTables Invoice -->
<div class="card shadow mb-4">
  <div class="card-header py-3" style="background-color: #FFF6F6;">
    <h6 class="m-0 font-weight-bold text-danger">
      Daftar Invoice
    </h6>
  </div>
  <div class="card-body text-xs">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>#</th>
            <th>Invoice No.</th>
            <th>Payment Date</th>
            <th>Payment Status</th>
            <th>Last Updated</th>
            <th>Action</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>#</th>
            <th>Invoice No.</th>
            <th>Payment Date</th>
            <th>Payment Status</th>
            <th>Last Updated</th>
            <th>Action</th>
          </tr>
        </tfoot>
        <tbody>
          <?php
          $i = 1;
          foreach ($invoice as $inv) :
          ?>
            <tr>
              <td class="align-middle text-center"><?= $i++; ?></td>
              <td class="align-middle" style="width:22%;"><a href="<?= base_url('invoice') . '/' . $inv['file_path'] ?>"><?= $inv['nomor_invoice'] ?></a></td>
              <td class="align-middle"><?= date('D, d M Y', strtotime($inv['payment_date'])) ?></td>
              <td class="align-middle"><span class="p-1 rounded text-light d-inline-block w-100 text-center <?= ($inv['status'] == "FULL PAYMENT" ? "bg-success" : "bg-warning") ?>"><?= $inv['status'] ?></span></td>
              <td class="align-middle"><?= $inv['updated_at'] ?></td>
              <td class="align-middle text-center"><a href="<?= base_url('/menu/resi') . '/' . $inv['nomor_invoice'] ?>" class="btn btn-info btn-sm btn-edit text-xs d-block">View More</a></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>