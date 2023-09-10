<?= $this->extend('layout/table'); ?>
<?= $this->section('content'); ?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800 font-weight-bold text-uppercase">Daftar Customer</h1>
<div class="row mb-4">
  <div class="col-lg-8 ">
    <p>
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora, quaerat sunt. Vitae illum esse, est ratione eveniet necessitatibus officiis hic numquam eius exercitationem fugiat atque, aperiam iusto, ex omnis veritatis.
    </p>
  </div>
  <div class="col-lg-4">

    <!-- validation error -->
    <?php if ($validation->hasError('customerName')) : ?>
      <div class="alert alert-danger" role="alert">
        <?= $validation->getError('customerName'); ?>
      </div>
    <?php elseif ($validation->hasError('nomor_telpon')) : ?>
      <div class="alert alert-danger" role="alert">
        <?= $validation->getError('nomor_telpon'); ?>
      </div>
    <?php elseif ($validation->hasError('alamat')) : ?>
      <div class="alert alert-danger" role="alert">
        <?= $validation->getError('alamat'); ?>
      </div>
    <?php endif; ?>

    <!-- upload error -->
    <?php if (session()->getFlashdata('info')) : ?>
      <?php if (session()->getFlashdata('info') == 'success-add') : ?>
        <div class="alert alert-success" role="alert">
          Customer berhasil ditambah.
        </div>
      <?php elseif (session()->getFlashdata('info') == 'success-edit') : ?>
        <div class="alert alert-success" role="alert">
          Customer berhasil diupdate.
        </div>
      <?php elseif (session()->getFlashdata('info') == 'success-delete') : ?>
        <div class="alert alert-success" role="alert">
          Customer berhasil dihapus.
        </div>
      <?php endif; ?>
    <?php endif; ?>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary float-right btn-customer-add" data-toggle="modal" data-target="#staticBackdrop">
      Add Customer
    </button>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title font-weight-bold" id="staticBackdropLabel">ADD CUSTOMER</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="<?= base_url('/master/addcustomer') ?>" method="POST">
              <input type="hidden" id="id_customer" name="id_customer">
              <div class="form-group">
                <label for="customerName">Nama Customer</label>
                <input class="form-control" type="text" placeholder="Nama Customer" id="customerName" name="customerName">
              </div>
              <div class="form-group">
                <label for="nomor_telpon">Nomor Telpon</label>
                <input class="form-control" type="text" placeholder="Nomor Telpon" id="nomor_telpon" name="nomor_telpon">
              </div>
              <div class="form-group">
                <label for="instagram">Instagram</label>
                <input class="form-control" type="text" placeholder="Instagram" id="instagram" name="instagram">
              </div>
              <div class="form-group">
                <label for="alamat">Alamat</label>
                <input class="form-control" type="text" placeholder="Alamat" id="alamat" name="alamat">
              </div>
              <div class="modal-footer px-0">
                <button type="button" class="btn btn-light border border-danger text-danger" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger btn-customer-submit">Save</button>
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
      Daftar Customer
    </h6>
  </div>
  <div class="card-body text-xs">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>#</th>
            <th>Nama</th>
            <th>Customer Code</th>
            <th>Nomor Telpon</th>
            <th>Alamat</th>
            <th>Instagram</th>
            <th>Action</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>#</th>
            <th>Nama</th>
            <th>Customer Code</th>
            <th>Nomor Telpon</th>
            <th>Alamat</th>
            <th>Instagram</th>
            <th>Action</th>
          </tr>
        </tfoot>
        <tbody>
          <?php
          $i = 1;
          foreach ($customer as $cs) :
          ?>
            <tr>
              <td class="align-middle text-center"><?= $i++; ?></td>
              <td class="align-middle"><?= $cs['nama'] ?></td>
              <td class="align-middle"><?= $cs['customer_code'] ?></td>
              <td class="align-middle"><?= $cs['nomor_telpon'] ?></td>
              <td class="align-middle"><?= $cs['alamat'] ?></span></td>
              <td class="align-middle"><?= $cs['instagram'] ?></span></td>
              <td class="align-middle text-center"><button class="btn btn-info btn-sm btn-customer-edit text-xs" data-id="<?= $cs['id'] ?>" data-toggle="modal" data-target="#staticBackdrop">Update</button> | <a href="<?= base_url('/master/deletecustomer' . '/' . $cs['id']) ?>" class="btn btn-warning btn-sm btn-edit  text-xs" onclick="return confirm('Hapus data customer ini?')">Delete</a></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>