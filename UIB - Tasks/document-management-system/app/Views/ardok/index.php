<?= $this->extend('layout/general'); ?>

<?= $this->section('content'); ?>
<!-- DataTables Example -->
<div class="text-right">
  <button class="btn btn-primary mb-3 text-right" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-upload"></i></button>
</div>
<?php if (session()->getFlashdata('info')): ?>
  <div class="alert alert-success" role="alert">
      <?=session()->getFlashdata('info');?>
  </div>
<?php endif;?>
<?php 
  $error = $validation->getErrors();
  if($error): 
      foreach($error as $err):
?>
  <div class="alert alert-warning" role="alert">
      <?= $err ?>
  </div>
<?php 
    endforeach;
    endif;
?>
<!-- Modal Upload-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload file arsip</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('ardok/upload') ?>" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <label for="nama">Nama Dokumen</label>
            <input type="text" class="form-control" id="nama" name="nama" aria-describedby="namadokumen" placeholder="Nama Dokumen...">
          </div>
          <div class="form-group">
            <label for="jenis_dok">Jenis Dokumen</label>
            <select class="form-control" id="jenis_dok" name="jenis_dok">
              <option selected value="Akta PT">Akta PT</option>
              <option value="NIB">NIB</option>
              <option value="NPWP">NPWP</option>
              <option value="KTP">KTP</option>
              <option value="PL">PL</option>
              <option value="SHGB">SHGB</option>
              <option value="SKEP & SPPL">SKEP & SPPL</option>
              <option value="Dok. Induk">Dok. Induk</option>
            </select>
          </div>
          <div class="form-group">
            <label for="uploadFile">Upload Dokumen</label>
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="uploadFile" name="uploadFile" onchange="nametag()">
              <label class="custom-file-label" for="uploadFile">Pilih Dokumen</label>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End of Modal Upload -->

<!-- Modal Update -->
<div class="modal fade" id="modalUpdate" tabindex="-1" aria-labelledby="modalUpdateLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalUpdateLabel">Upload file arsip</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('ardok/update') ?>" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <label for="nama">Nama Dokumen</label>
            <input type="text" class="form-control" id="nama" name="nama" aria-describedby="namadokumen" placeholder="Nama Dokumen..." value="">
          </div>
          <div class="form-group">
            <label for="jenis_dok">Jenis Dokumen</label>
            <select class="form-control" id="jenis_dok" name="jenis_dok">
              <option selected value="Akta PT">Akta PT</option>
              <option value="NIB">NIB</option>
              <option value="NPWP">NPWP</option>
              <option value="KTP">KTP</option>
              <option value="PL">PL</option>
              <option value="SHGB">SHGB</option>
              <option value="SKEP & SPPL">SKEP & SPPL</option>
              <option value="Dok. Induk">Dok. Induk</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-warning">Ubah</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End of Modal Update -->

<!-- Tabel -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">DataTables Dokumen</h6>
  </div>
<div class="card-body">
  <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
              <tr>
                  <th class="text-center align-middle">#</th>
                  <th class="align-middle">Nama Dokumen</th>
                  <th class="align-middle">Jenis Dokumen</th>
                  <th class="align-middle">Tanggal Upload</th>
                  <th class="text-center align-middle">Aksi</th>
              </tr>
          </thead>
          <tfoot>
              <tr>
                  <th class="text-center align-middle">#</th>
                  <th class="align-middle">Nama Dokumen</th>
                  <th class="align-middle">Jenis Dokumen</th>
                  <th class="align-middle">Tanggal Upload</th>
                  <th class="text-center align-middle">Aksi</th>
              </tr>
          </tfoot>
          <tbody>
            <?php 
              $i = 1;
              foreach($dokumen as $dok):
            ?>
              <tr>
                  <td class="text-center align-middle"><?= $i++; ?></td>
                  <td class="align-middle"><?= $dok['nama']; ?></td>
                  <td class="align-middle"><?= $dok['jenis_dok']; ?></td>
                  <td class="align-middle"><?= date_format(date_create($dok['created_at']), 'd M Y') ?></td>
                  <td class="text-center align-middle">
                    <a href="<?= base_url('ardok/download') . '/' . $dok['path']; ?>" class="btn btn-info d-inline-block"><i class="fas fa-download"></i></a> | 
                    <a onclick="return confirm('Yakin mau hapus dokumen ini?');"href="<?= base_url('ardok/delete') . '/' . $dok['id']; ?>" class="btn btn-danger d-inline-block"><i class="fas fa-trash"></i></a>
                  </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
      </table>
  </div>
</div>
</div>
<?= $this->endSection(); ?>