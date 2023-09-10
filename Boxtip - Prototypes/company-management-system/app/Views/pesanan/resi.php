<?= $this->extend('layout/table'); ?>
<?= $this->section('content'); ?>
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800 font-weight-bold text-uppercase">Daftar Pesanan</h1>
<div class="row mb-4">
  <div class="col-lg-6">
    <div class="row mb-3">
      <div class="col-4 font-weight-bold text-gray-800">
        Nomor Invoice
      </div>
      <div class="col-8 font-weight-bold text-gray-800">
        <?= ": " . $nomor_invoice ?>
      </div>
    </div>
    <div class="row">
      <div class="col-4 font-weight-bold text-gray-800">
        Nama
      </div>
      <div class="col-8 font-weight-bold text-gray-800">
        <?= ": " . session()->get('nama') ?>
      </div>
    </div>
  </div>
</div>

<!-- DataTables Invoice -->
<div class="card shadow mb-4">
  <div class="card-header py-3" style="background-color: #FFF6F6;">
    <h6 class="m-0 font-weight-bold text-danger">
      Daftar Resi
    </h6>
  </div>
  <div class="card-body text-xs">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>#</th>
            <th>Nomor Resi</th>
            <th>Last Status</th>
            <th>Last Updated</th>
            <th>Action</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>#</th>
            <th>Nomor Resi</th>
            <th>Last Status</th>
            <th>Last Updated</th>
            <th>Action</th>
          </tr>
        </tfoot>
        <tbody>
          <?php
          $i = 1;
          foreach ($resi as $rs) :
          ?>
            <tr>
              <td class="align-middle text-center"><?= $i++; ?></td>
              <td class="align-middle" style="width:22%;"><?= $rs['nomor_resi_boxtip'] ?></td>
              <td class="align-middle"><?= $rs['status'] ?></td>
              <td class="align-middle"><?= ($rs['updated_at'] == "0000-00-00 00:00:00") ? $rs['created_at'] : $rs['updated_at'] ?></td>
              <td class="align-middle text-center"><a target="_blank" href="<?= base_url('/menu/cekresi') . '/' . $rs['nomor_resi_boxtip'] ?>" class="btn btn-info btn-sm text-xs d-block">More Info</a></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>