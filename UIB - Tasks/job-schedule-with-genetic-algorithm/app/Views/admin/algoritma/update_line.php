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
          <input type="text" name="pekerjaan_id" value=" <?= (isset($data)) ? $data['pekerjaan_id']['id'] : "" ?>" class="d-none" />
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label>Pekerjaan</label>
                <input type="text" class="form-control form-control-border" value="<?= (isset($data)) ? $data['pekerjaan_id']['nama'] : '' ?>" readonly>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label>Urutan</label>
                <input type="text" class="form-control form-control-border" value="<?= (isset($data)) ? $data['urutan'] : '' ?>" readonly>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label>Proses</label>
                <input type="text" class="form-control form-control-border" value="<?= (isset($data)) ? $data['proses_id']['nama'] : '' ?>" readonly>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label>Kategori Mesin</label>
                <input type="text" class="form-control form-control-border" value="<?= (isset($data)) ? $data['kategori_mesin_id']['nama'] : '' ?>" readonly>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label>Mesin</label>
                <select name="mesin_id" class="custom-select">
                  <?php
                  $db = \Config\Database::connect();
                  $builder = $db->table('mesin');
                  $mesin = $builder->select('*')->getWhere(['kategori_mesin_id' => $data['kategori_mesin_id']['id']])->getResultArray();
                  foreach ($mesin as $ms) :
                  ?>
                    <option value="<?= $ms['id'] ?>"><?= $ms['nama'] ?></option>
                  <?php endforeach; ?>
                </select>
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