<?= $this->extend('templates/template_admin'); ?>
<?= $this->section('content'); ?>
<div class="card">
  <div class="card-header">
    <h3 class="card-title">DataTable Proses Pekerjaan</h3>
    <a class="btn btn-primary btn-sm float-right" href="<?= base_url() ?>/proses_pekerjaan/tambah_proses_pekerjaan">Tambah Data</a>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="data_table" class="table table-bordered table-striped table-sm">
      <thead>
        <tr>
          <th>#</th>
          <th>Nama</th>
          <th>Urutan</th>
          <th>Kategori Pekerjaan</th>
          <th>Kategori Mesin</th>
          <th class="text-center">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $i = 1;
        foreach ($data as $dt) :
        ?>
          <tr>
            <td><?= $i++ ?></td>
            <td><?= $dt['nama']; ?></td>
            <td><?= $dt['urutan'] ?></td>
            <td><?= $dt['kategori_pekerjaan_id'] ?></td>
            <td><?= $dt['kategori_mesin_id'] ?></td>
            <td class="text-center">
              <a class="btn btn-warning btn-sm" href="<?= base_url() . "/" . "proses_pekerjaan/ubah_proses_pekerjaan/{$dt['id']}" ?>"><i class="fas fa-pen"></i></a>
              <a class="btn btn-outline-danger btn-sm" href="<?= base_url() . "/" . "proses_pekerjaan/hapus_proses_pekerjaan/{$dt['id']}" ?>"><i class="fas fa-minus"></i></a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
      <tfoot>
        <tr>
          <th>#</th>
          <th>Nama</th>
          <th>Urutan</th>
          <th>Kategori Pekerjaan</th>
          <th>Kategori Mesin</th>
          <th class="text-center">Actions</th>
        </tr>
      </tfoot>
    </table>
  </div>
  <!-- /.card-body -->
</div>
<?= $this->endSection(); ?>