<?= $this->extend('layout/general'); ?>
<?= $this->section('content'); ?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800 font-weight-bold text-uppercase">Create User</h1>
<div class="row">
  <div class="col-md-5 p-0 card shadow ml-2 mb-4">
    <div class="card-header m-0 py-3" style="background-color: #FFF6F6;">
      <h6 class="m-0 font-weight-bold text-danger">
        Create User
      </h6>
    </div>
    <div class="card-body">
      <form action="<?= base_url('/master/createuser') ?>" method="POST">
        <div class="form-group row">
          <label for="username" class="col-sm-4 col-form-label">Email</label>
          <div class="col-sm-8">
            <input type="hidden" name="username" value="<?= $customer_code ?>">
            <input class="form-control form-control-muted" disabled value="<?= $customer_code ?>">
          </div>
        </div>
        <div class="form-group row">
          <label for="password" class="col-sm-4 col-form-label">Password</label>
          <div class="col-sm-8">
            <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>" id=" password" name="password" placeholder="Password">
            <div class="invalid-feedback">
              <?= $validation->getError('password'); ?>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-danger float-right">Create</button>
      </form>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>