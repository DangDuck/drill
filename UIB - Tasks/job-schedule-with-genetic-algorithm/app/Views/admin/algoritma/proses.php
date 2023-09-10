<?= $this->extend('templates/template_admin'); ?>
<?= $this->section('content'); ?>
<div class="card">
  <div class="card-header">
    <h3 class="card-title"><?= $title; ?></h3>
    <a href="<?= base_url() . '/' . 'generate_line' ?>" class="btn btn-sm btn-info float-right">Generate Line</a>
  </div>
  <!-- /.card-header -->
  <div class=" card-body">
    <table id="data_table" class="table table-bordered table-striped table-sm">
      <thead>
        <tr>
          <th>#</th>
          <th>Pekerjaan</th>
          <th>Urutan</th>
          <th>Proses</th>
          <th>Kategori Mesin</th>
          <th>Mesin</th>
          <th>Waktu</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $i = 1;
        foreach ($data as $dt) :
        ?>
          <tr>
            <td style="vertical-align: middle;"><?= $i++ ?></td>
            <td style="vertical-align: middle;"><?= $dt['pekerjaan_id']['nama'] ?></td>
            <td style="vertical-align: middle;"><?= $dt['urutan'] ?></td>
            <td style="vertical-align: middle;"><?= $dt['proses_id']['nama'] ?></td>
            <td style="vertical-align: middle;"><?= $dt['kategori_mesin_id']['nama'] ?></td>
            <td style="vertical-align: middle;">
              <?php if ($dt['mesin_id']) : ?>
                <?= $dt['mesin_id']['nama']; ?>
              <?php else : ?>
                Not Set
              <?php endif; ?>
            </td>
            <td style="vertical-align: middle;">
              <?php if ($dt['waktu']) : ?>
                <?= $dt['waktu']; ?>
              <?php else : ?>
                NaN
              <?php endif; ?>
            </td>
            <td style="vertical-align: middle;">
              <a href="<?= base_url() . "/" . "pekerjaan_line/{$dt['id']}" ?>" class="btn btn-sm btn-warning w-100">Update</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
      <tfoot>
        <tr>
          <th>#</th>
          <th>Pekerjaan</th>
          <th>Urutan</th>
          <th>Proses</th>
          <th>Kategori Mesin</th>
          <th>Mesin</th>
          <th>Waktu</th>
          <th>Action</th>
        </tr>
      </tfoot>
    </table>
  </div>
  <!-- /.card-body -->
</div>
<?= $this->endSection(); ?>