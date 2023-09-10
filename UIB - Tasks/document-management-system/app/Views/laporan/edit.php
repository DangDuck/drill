<?= $this->extend('layout/general'); ?>

<?= $this->section('content'); ?>
<div class="row mb-3">
  <div class="col">
    <h6 class="h5 mb-0 text-gray-600">- <?= $sub ?></h6>
  </div>
</div>
<hr>
<div class="row ">
  <div class="col-xl-8 col-lg-10">
      <form action="<?= base_url('laporan/update/' . $laporan['id']) ?>" method="POST">
        <div class="row">
          <div class="col">
            <div class="form-group">
              <div class="card mb-4 border-left-info">
                <div class="card-body">
                  <?= $laporan['nama']; ?>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="card mb-4 border-left-info">
                <div class="card-body">
                  <?= $laporan['no_dok']; ?>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="card mb-4 border-left-info">
                <div class="card-body">
                  <?= $laporan['alamat']; ?>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="card mb-4 border-left-info">
                <div class="card-body">
                  <?= $laporan['no_telp']; ?>
                </div>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="tahap">Tahap</label>
              <select id="tahap" name="tahap" class="form-control <?= ($validation->hasError('tahap')) ? 'is-invalid' : '' ?>">
                <option selected disabled>Pilih Tahap...</option>
                <option <?= ($laporan['tahap'] == 'UWTO') ? 'selected' : '' ?> value="UWTO">UWTO</option>
                <option <?= ($laporan['tahap'] == 'SKEP & SPPL') ? 'selected' : '' ?> value="SKEP & SPPL">SKEP & SPPL</option>
                <option <?= ($laporan['tahap'] == 'Rekomendasi') ? 'selected' : '' ?> value="Rekomendasi">Rekomendasi</option>
                <option <?= ($laporan['tahap'] == 'Legalisir') ? 'selected' : '' ?> value="Legalisir">Legalisir</option>
                <option <?= ($laporan['tahap'] == 'SK BPN') ? 'selected' : '' ?> value="SK BPN">SK BPN</option>
                <option <?= ($laporan['tahap'] == 'TERBIT SHGB') ? 'selected' : '' ?> value="Terbit SHGB">Terbit SHGB</option>
              </select>
              <div class="invalid-feedback">
                  <?= $validation->getError('tahap'); ?>
              </div>
            </div>
            <div class="form-group">
              <label for="catatan">Catatan</label>
              <textarea class="form-control <?= ($validation->hasError('catatan')) ? 'is-invalid' : '' ?>" id="catatan" name="catatan" placeholder="<?= $laporan['catatan']; ?>"></textarea>
              <div class="invalid-feedback">
                  <?= $validation->getError('catatan'); ?>
              </div>
            </div>
            <button type="submit" class="btn btn-warning">Simpan</button>
          </div>
        </div>
    </form>
  </div>
</div>
<?= $this->endSection(); ?>