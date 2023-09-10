<?= $this->extend('layout/table'); ?>
<?= $this->section('content'); ?>
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800 font-weight-bold text-uppercase">Detail Resi</h1>
<div class="row mb-4">
  <div class="col-lg-6 font-weight-bold text-gray-800 text-break">
    <div class="row mb-3">
      <div class="col-sm-5">
        No. Resi
      </div>
      <div class="col-sm-7">
        <p>: <?= $resi['nomor_resi'] ?></p>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-5 ">
        No. Invoice
      </div>
      <div class="col-sm-7 ">
        : <?= $resi['nomor_invoice'] ?>
      </div>
    </div>
  </div>
</div>

<!-- DataTables Invoice -->
<div class="card shadow mb-4">
  <div class="card-header py-3" style="background-color: #FFF6F6;">
    <h6 class="m-0 font-weight-bold text-danger">
      Detail Resi No. <?= $resi['nomor_resi'] ?>
    </h6>
  </div>
  <div class="card-body text-xs">
    <div class="row">
      <div class="col-sm-2">
        Last Status
      </div>
      <div class="col-sm-4">
        <?= ': ' . $resi['status'] ?>
      </div>
    </div>
    <div class="row mt-2">
      <div class="col-sm-2">
        Last Updated
      </div>
      <div class="col-sm-4">
        <?= ': ' ?>
        <?= ($resi['updated_at'] == "0000-00-00 00:00:00") ? $resi['created_at'] : $resi['updated_at'] ?>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-md-6">
        <?php
        $i = 0;
        foreach ($status as $st) :
          $i++;
        ?>
          <div class="card border-left-success rounded-0">
            <div class="timeline-head <?= ($i == $resi['id_status']) ? 'timeline-loading' : '' ?>"></div>
            <div class="card-body py-2">
              <div class="card-title text-gray-900 font-weight-bold"><?= $st['status']; ?></div>
              <div class="card-body p-0">
                <?= $st['keterangan']; ?>
              </div>
            </div>
          </div>
        <?php
          if ($i == $resi['id_status']) break;
        endforeach; ?>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>