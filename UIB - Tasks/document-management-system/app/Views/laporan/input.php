<?= $this->extend('layout/general'); ?>

<?= $this->section('content'); ?>
<div class="row mb-3">
  <div class="col">
    <h6 class="h5 mb-0 text-gray-600">- <?= $sub ?></h6>
  </div>
</div>
<div class="row">
  <div class="col-xl-8 col-lg-10">
    <form action="<?= base_url('laporan/add') ?>" method="POST">
      <div class="form-row my-3 ">
        <div class="form-group col-md-6">
          <label for="nama">Nama</label>
          <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : '' ?>" id="nama" name="nama" value="<?= old('nama'); ?>">
          <div class="invalid-feedback">
            <?= $validation->getError('nama'); ?>
          </div>
        </div>
        <div class="form-group col-md-6">
          <label for="no_dok">Nomor Dokumen</label>
          <input type="text" class="form-control <?= ($validation->hasError('no_dok')) ? 'is-invalid' : '' ?>" id="no_dok" name="no_dok" value="<?= old('no_dok') ?>">
          <div class="invalid-feedback">
            <?= $validation->getError('no_dok'); ?>
          </div>
        </div>
      </div>
      <div class="form-row my-3">
        <div class="form-group col-md-6">
          <label for="alamat">Alamat</label>
          <input type="text" class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : '' ?>" id="alamat" name="alamat" value="<?= old('alamat') ?>">
          <div class="invalid-feedback">
            <?= $validation->getError('alamat'); ?>
          </div>
        </div>
        <div class="form-group col-md-6">
          <label for="tahap">Tahap</label>
          <select id="tahap" name="tahap" class="form-control <?= ($validation->hasError('tahap')) ? 'is-invalid' : '' ?>">
            <option selected disabled>Pilih Tahap...</option>
            <option value="UWTO">UWTO</option>
            <option value="SKEP & SPPL">SKEP & SPPL</option>
            <option value="Rekomendasi">Rekomendasi</option>
            <option value="Legalisir">Legalisir</option>
            <option value="SK BPN">SK BPN</option>
            <option value="Terbit SHGB">Terbit SHGB</option>
          </select>
          <div class="invalid-feedback">
            <?= $validation->getError('tahap'); ?>
          </div>
        </div>
      </div>
      <div class="form-row my-3">
        <div class="form-group col-md-6">
          <label for="no_telp">Nomor Telpon</label>
          <input type="text" class="form-control <?= ($validation->hasError('no_telp')) ? 'is-invalid' : '' ?>" id="no_telp" name="no_telp" value="<?= old('no_telp') ?>">
          <div class="invalid-feedback">
            <?= $validation->getError('no_telp'); ?>
          </div>
        </div>
        <div class="form-group col-md-6">
          <label for="catatan">Catatan</label>
          <input type="text" class="form-control <?= ($validation->hasError('catatan')) ? 'is-invalid' : '' ?>" id="catatan" name="catatan" value="<?= old('catatan') ?>">
          <div class="invalid-feedback">
            <?= $validation->getError('catatan'); ?>
          </div>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Tambahkan</button>
    </form>
  </div>
</div>
<?= $this->endSection(); ?>