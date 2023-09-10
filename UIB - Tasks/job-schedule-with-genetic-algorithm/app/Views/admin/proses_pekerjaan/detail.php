<?= $this->extend('templates/template_admin'); ?>
<?= $this->section('content'); ?>
<div class="row">
  <div class="col-6">
    <div class="card card-secondary">
      <div class="card-header">
        <h3 class="card-title">Form <?= $title; ?></h3>
      </div>
      <div class="card-body">
        <form action="<?= $action ?>" method="POST">
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control form-control-border" placeholder="Nama Proses Pekerjaan" name="input_nama" value="<?= (isset($data)) ? $data['nama'] : '' ?>" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label>Urutan</label>
                <input type="number" class="form-control form-control-border" placeholder="Urutan Proses Pekerjaan" name="input_urutan" value="<?= (isset($data)) ? $data['urutan'] : '' ?>" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label>Kategori Pekerjaan</label>
                <select class="custom-select form-control-border" name="input_kategori_pekerjaan_id" required>
                  <?php
                  $db = \Config\Database::connect();
                  $builder = $db->table('kategori_pekerjaan');
                  $options = $builder->get()->getResultArray();
                  foreach ($options as $opt) :
                  ?>
                    <option value="<?= $opt['id'] ?>" <?= (isset($data)) ? (($data['kategori_pekerjaan_id'] == $opt['id']) ? 'selected' : '') : '' ?>>
                      <?= $opt['nama'] ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label>Kategori</label>
                <select class="custom-select form-control-border" name="input_kategori_mesin_id" required>
                  <?php
                  $builder2 = $db->table('kategori_mesin');
                  $options2 = $builder2->get()->getResultArray();
                  foreach ($options2 as $opt) :
                  ?>
                    <option value="<?= $opt['id'] ?>" <?= (isset($data)) ? (($data['kategori_mesin_id'] == $opt['id']) ? 'selected' : '') : '' ?>>
                      <?= $opt['nama'] ?>
                    </option>
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