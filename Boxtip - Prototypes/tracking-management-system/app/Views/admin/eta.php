<?= $this->extend('admin/template'); ?>
<?= $this->section('link'); ?>
<!-- Custom styles for this page -->
<link href="../template/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<?= $this->endSection(); ?>
<?= $this->section('header'); ?>
<div class="col-lg-6 col-7">
  <h6 class="h2 text-white d-inline-block mb-0">Order in Warehouse</h6>
</div>
<div class="col-lg-6 col-5 text-right">
  <button class="btn btn-sm btn-neutral" data-toggle="modal" data-target="#modal-form-import">Import</button>
  <button class="btn btn-sm btn-neutral" data-toggle="modal" data-target="#modal-form-manual">Manual</button>
</div>
<?= $this->endSection(); ?>
<?= $this->section('content'); ?>
<!-- DataTables -->
<div class="card">
  <div class="card-header bg-transparent border-0">
    <h3 class="mb-0">Table</h3>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-flush" id="dataTable" width="100%" cellspacing="0">
        <thead class="thead-light">
          <tr>
            <th style="width: 5%;">Tandai</th>
            <th>#</th>
            <th>Nomor Resi</th>
            <th>Tanggal</th>
            <th>Status</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th style="width: 5%;">Tandai</th>
            <th>#</th>
            <th>Nomor Resi</th>
            <th>Tanggal</th>
            <th>Status</th>
          </tr>
        </tfoot>
        <tbody class="list">
          <tr>
            <td style="text-align: center;">
              <input type="checkbox">
            </td>
            <td>1</td>
            <td>091283asdf832</td>
            <td>12-Mei-2021</td>
            <td>ETA</td>
          </tr>
          <tr>
            <td style="text-align: center;">
              <input type="checkbox">
            </td>
            <td>2</td>
            <td>slkdfj9208</td>
            <td>12-Mei-2021</td>
            <td>ETA</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- Modal import -->
<div class="modal fade" id="modal-form-import" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
  <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-body p-0">
        <div class="card bg-secondary border-0 mb-0">
          <div class="card-header bg-transparent pb-2">
            <div class="text-muted text-center mt-2 mb-3"><small>Import Excel File to Update to ETA Status</small></div>
          </div>
          <div class="card-body">
            <form>
              <div class="custom-file text-sm">
                <input type="file" class="custom-file-input" id="customFileLang" lang="en">
                <label class="custom-file-label" for="customFileLang">Select file</label>
              </div>
              <div class="text-center">
                <button type="button" class="btn btn-primary my-4">Upload</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End modal import -->
<!-- Modal manual -->
<div class="modal fade" id="modal-form-manual" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
  <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-body p-0">
        <div class="card bg-secondary border-0 mb-0">
          <div class="card-header bg-transparent pb-2">
            <div class="text-muted text-center mt-2 mb-3"><small>Manual Update to ETA Status</small></div>
          </div>
          <div class="card-body">
            <form role="form text-sm">
              <div class="form-group mb-3">
                <label for="etaStatus">Update to ETA Status</label>
                <textarea class="form-control" id="etaStatus" rows="3"></textarea>
              </div>
              <div class="text-center">
                <button type="button" class="btn btn-primary my-4">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End modal manual -->
<?= $this->endSection(); ?>
<?= $this->section('script'); ?>
<!-- Page level plugins -->
<script src="../template/datatables/jquery.dataTables.min.js"></script>
<script src="../template/datatables/dataTables.bootstrap4.min.js"></script>
<script src="../template/datatables/datatables-demo.js"></script>
<?= $this->endSection(); ?>