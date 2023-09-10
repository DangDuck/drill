<?= $this->extend('templates/template_admin'); ?>
<?= $this->section('content'); ?>
<div class="row">
  <div class="col-6">
    <div class="card card-secondary">
      <div class="card-header">
        <h3 class="card-title">Form <?= $title ?></h3>
      </div>
      <div class="card-body">
        <form action="<?= $action ?>" method="POST">
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control form-control-border" placeholder="Nama Kategori Pekerjaan" name="input_nama" value="<?= (isset($data)) ? $data['nama'] : '' ?>" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <button type="submit" class="btn btn-primary float-right">Save</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>