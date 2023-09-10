<?= $this->extend('layout/general'); ?>
<?= $this->section('content'); ?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800 font-weight-bold text-uppercase">Change Password</h1>

<?php if (session()->getFlashdata('info')) : ?>
  <?php if (session()->getFlashdata('info') == 'password-changed') : ?>
    <div class="alert alert-success" role="alert">
      Password berhasil diubah.
    </div>
  <?php elseif (session()->getFlashdata('info') == 'password-wrong') : ?>
    <div class="alert alert-success" role="alert">
      Password salah.
    </div>
  <?php endif; ?>
<?php endif; ?>

<div class="row">
  <div class="col-md-8 p-0 card shadow ml-2 mb-4">
    <div class="card-header m-0 py-3" style="background-color: #FFF6F6;">
      <h6 class="m-0 font-weight-bold text-danger">
        Change Password
      </h6>
    </div>
    <div class="card-body">
      <form action="<?= base_url('/home/newpassword') ?>" method="POST">
        <div class="form-group row">
          <label for="oldPassword" class="col-sm-4 col-form-label">Old Password</label>
          <div class="col-sm-8">
            <input type="password" class="form-control <?= ($validation->hasError('oldPassword')) ? 'is-invalid' : '' ?>" id=" oldPassword" name="oldPassword" placeholder="Old Password">
            <div class="invalid-feedback">
              <?= $validation->getError('oldPassword'); ?>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="password" class="col-sm-4 col-form-label">New Password</label>
          <div class="col-sm-8">
            <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>" id=" password" name="password" placeholder="Password">
            <div class="invalid-feedback">
              <?= $validation->getError('password'); ?>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="rePassword" class="col-sm-4 col-form-label">Re Password</label>
          <div class="col-sm-8">
            <input type="password" class="form-control <?= ($validation->hasError('rePassword')) ? 'is-invalid' : '' ?>" id="rePassword" name="rePassword" placeholder="Re-enter Password">
            <div class="invalid-feedback">
              <?= $validation->getError('rePassword'); ?>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-danger float-right">Change</button>
      </form>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>