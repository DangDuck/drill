<?= $this->extend('templates/template_admin'); ?>
<?= $this->section('content'); ?>
<div class="card">
  <div class="card-header">
    <h3 class="card-title">DataTable Mesin</h3>
    <a class="btn btn-primary btn-sm float-right" href="<?= base_url() ?>/mesin/tambah_mesin">Tambah Data</a>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="data_table" class="table table-bordered table-striped table-sm">
      <thead>
        <tr>
          <th>#</th>
          <th>Nama</th>
          <th>Kategori</th>
          <th>Kapasitas</th>
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
            <td><?= $dt['kategori_mesin_id'] ?></td>
            <td><?= $dt['kapasitas'] ?></td>
            <td class="text-center">
              <a class="btn btn-warning btn-sm" href="<?= base_url() . "/" . "mesin/ubah_mesin/{$dt['id']}" ?>"><i class="fas fa-pen"></i></a>
              <a class="btn btn-outline-danger btn-sm" href="<?= base_url() . "/" . "mesin/hapus_mesin/{$dt['id']}" ?>"><i class="fas fa-minus"></i></a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
      <tfoot>
        <tr>
          <th>#</th>
          <th>Nama</th>
          <th>Kategori</th>
          <th>Kapasitas</th>
          <th>Actions</th>
        </tr>
      </tfoot>
    </table>
  </div>
  <!-- /.card-body -->
</div>
<?= $this->endSection(); ?>