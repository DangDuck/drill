<?= $this->extend('layout/table'); ?>
<?= $this->section('content'); ?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800 font-weight-bold text-uppercase">Daftar Resi</h1>
<div class="row mb-4">
  <div class="col-lg-8 ">
    <p>
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora, quaerat sunt. Vitae illum esse, est ratione eveniet necessitatibus officiis hic numquam eius exercitationem fugiat atque, aperiam iusto, ex omnis veritatis.
    </p>
  </div>
  <div class="col-lg-4">
    <!-- validation error -->
    <?php if ($validation->hasError('nomor_resi')) : ?>
      <div class="alert alert-danger" role="alert">
        <?= $validation->getError('nomor_resi'); ?>
      </div>
    <?php elseif ($validation->hasError('nomor_invoice')) : ?>
      <div class="alert alert-danger" role="alert">
        <?= $validation->getError('nomor_invoice'); ?>
      </div>
    <?php elseif ($validation->hasError('status')) : ?>
      <div class="alert alert-danger" role="alert">
        <?= $validation->getError('status'); ?>
      </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('info')) : ?>
      <?php if (session()->getFlashdata('info') == 'success-add') : ?>
        <div class="alert alert-success" role="alert">
          Resi berhasil ditambah.
        </div>
      <?php elseif (session()->getFlashdata('info') == 'success-edit') : ?>
        <div class="alert alert-success" role="alert">
          Resi berhasil diupdate.
        </div>
      <?php elseif (session()->getFlashdata('info') == 'success-delete') : ?>
        <div class="alert alert-success" role="alert">
          Resi berhasil dihapus.
        </div>
      <?php endif; ?>
    <?php endif; ?>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary float-right btn-resi-add" data-toggle="modal" data-target="#staticBackdrop">
      Add Resi
    </button>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title font-weight-bold" id="staticBackdropLabel">ADD RESI</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="<?= base_url('/master/addresi') ?>" method="POST">
              <input type="hidden" id="input_nomor_resi" name="input_nomor_resi">
              <input type="hidden" id="input_nomor_resi_boxtip" name="input_nomor_resi_boxtip">
              <div class="form-group">
                <label for="nomor_resi">Nomor Resi</label>
                <input class="form-control" type="text" placeholder="Nomor Resi" id="nomor_resi" name="nomor_resi">
              </div>
              <div class="form-group form-nomor-invoice">
                <label for="nomor_invoice">Nomor Invoice</label>
                <select class="form-control" id="nomor_invoice" name="nomor_invoice">
                  <option selected disabled>Select Invoice No.</option>
                  <?php foreach ($invoice as $inv) : ?>
                    <option value="<?= $inv['nomor_invoice'] ?>"><?= $inv['nomor_invoice'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group">
                <label for="status">Status Resi</label>
                <select class="form-control" id="status" name="status">
                  <option selected disabled>Select Status Resi</option>
                  <?php foreach ($status as $st) : ?>
                    <option value="<?= $st['id'] ?>"><?= $st['id'] . ' - ' . $st['status'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="modal-footer px-0">
                <button type="button" class="btn btn-light border border-danger text-danger" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger btn-resi-submit">Add</button>
              </div>
            </form>
          </div>
        </div>
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
            <th>Nomor Resi Boxtip</th>
            <th>Nomor Invoice</th>
            <th>Status Resi</th>
            <th>Action</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>#</th>
            <th>Nomor Resi</th>
            <th>Nomor Resi Boxtip</th>
            <th>Nomor Invoice</th>
            <th>Status Resi</th>
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
              <td class="align-middle"><?= $rs['nomor_resi'] ?></td>
              <td class="align-middle"><?= $rs['nomor_resi_boxtip'] ?></td>
              <td class="align-middle"><?= $rs['nomor_invoice'] ?></td>
              <td class="align-middle"><?= $rs['status'] ?></td>
              <td class="align-middle text-center"><button button class="btn btn-info btn-sm btn-resi-edit text-xs" data-id="<?= $rs['nomor_resi'] ?>" data-toggle="modal" data-target="#staticBackdrop">Update</button> | <a href="<?= base_url('/master/deleteresi' . '/' . $rs['nomor_resi']) ?>" class="btn btn-warning btn-sm text-xs" onclick="return confirm('Hapus data resi ini?')">Delete</a></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>