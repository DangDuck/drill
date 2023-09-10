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
                <label>Probabilitas Crossover</label>
                <input type="number" class="form-control form-control-border" placeholder="Nilai Probabilitas Crossover dalam persen" name="input_pc" min="0" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label>Probabilitas Mutasi</label>
                <input type="number" class="form-control form-control-border" placeholder="Nilai Probabilitas Mutasi dalam persen" name="input_pm" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label>Jumlah Generasi</label>
                <input type="number" class="form-control form-control-border" placeholder="Jumlah Generasi" name="input_total_gen" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label>Jumlah Error</label>
                <input type="number" class="form-control form-control-border" placeholder="Jumlah Error" name="input_total_err" required>
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