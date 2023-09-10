<?= $this->extend('layout/table'); ?>
<?= $this->section('content'); ?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800 font-weight-bold text-uppercase">Daftar User</h1>
<div class="row mb-4">
  <div class="col-lg-8 ">
    <p>
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora, quaerat sunt. Vitae illum esse, est ratione eveniet necessitatibus officiis hic numquam eius exercitationem fugiat atque, aperiam iusto, ex omnis veritatis.
    </p>
  </div>
  <div class="col-lg-4">

    <!-- upload error -->
    <?php if (session()->getFlashdata('info')) : ?>
      <?php if (session()->getFlashdata('info') == 'success-add') : ?>
        <div class="alert alert-success" role="alert">
          User berhasil ditambah.
        </div>
      <?php elseif (session()->getFlashdata('info') == 'success-edit') : ?>
        <div class="alert alert-success" role="alert">
          Password berhasil diupdate.
        </div>
      <?php elseif (session()->getFlashdata('info') == 'success-delete') : ?>
        <div class="alert alert-success" role="alert">
          User berhasil dihapus.
        </div>
      <?php endif; ?>
    <?php endif; ?>
  </div>
</div>

<!-- DataTables Invoice -->
<div class="card shadow mb-4">
  <div class="card-header py-3" style="background-color: #FFF6F6;">
    <h6 class="m-0 font-weight-bold text-danger">
      Daftar User
    </h6>
  </div>
  <div class="card-body text-xs">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>#</th>
            <th>Customer Code</th>
            <th>Nama</th>
            <th>Instagram</th>
            <th>Username</th>
            <th>Action</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>#</th>
            <th>Customer Code</th>
            <th>Nama</th>
            <th>Instagram</th>
            <th>Username</th>
            <th>Action</th>
          </tr>
        </tfoot>
        <tbody>
          <?php
          $i = 1;
          foreach ($user as $us) :
          ?>
            <tr>
              <td class="align-middle text-center"><?= $i++; ?></td>
              <td class="align-middle"><?= $us['customer_code'] ?></td>
              <td class="align-middle"><?= $us['nama'] ?></td>
              <td class="align-middle"><?= $us['instagram'] ?></td>
              <?php if ($us['username']) : ?>
                <td class="align-middle text-center"><?= $us['username'] ?></td>
                <td class="align-middle text-center"><a href="<?= base_url('/master/resetpassword' . '/' . $us['username']) ?>" class="btn btn-info btn-sm btn-customer-edit text-xs">Update</a> | <a href="<?= base_url('/master/deleteuser' . '/' . $us['username']) ?>" class="btn btn-warning btn-sm btn-edit text-xs" onclick="return confirm('Hapus data user ini?')">Delete</a></td>
              <?php else : ?>
                <td class="align-middle text-center">
                  <a href="<?= base_url('/master/adduser') . '/' . $us['customer_code']; ?>" class="btn btn-primary btn-sm text-xs">Create Account</a>
                </td>
                <td class="align-middle text-center"><button disabled class="btn btn-info btn-sm text-xs">Update</button> | <button disabled class="btn btn-warning btn-sm btn-edit text-xs">Delete</button></td>
              <?php endif; ?>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>