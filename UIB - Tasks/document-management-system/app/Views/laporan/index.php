<?=$this->extend('layout/general');?>

<?=$this->section('content');?>
<!-- DataTables Example -->
<div class="row mb-3">
  <div class="col">
    <h6 class="h5 mb-0 text-gray-600">- <?=$sub?></h6>
  </div>
  <div class="col text-right">
    <a href="<?=base_url('laporan/input')?>" class="btn btn-primary btn-icon-split">
      <span class="icon text-white-50">
          <i class="fas fa-plus"></i>
      </span>
      <span class="text">Input Laporan</span>
    </a>
  </div>
</div>
<div class="card shadow mb-4">
  <?php if (session()->getFlashdata('info')): ?>
    <div class="alert alert-success" role="alert">
        <?=session()->getFlashdata('info');?>
    </div>
  <?php endif;?>
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">DataTables Laporan</h6>
  </div>
<div class="card-body">
  <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
              <tr>
                  <th class="text-center align-middle">#</th>
                  <th class="align-middle">Nama</th>
                  <th class="align-middle">Alamat</th>
                  <th class="align-middle">No. Dokumen</th>
                  <th class="align-middle">No. Telp</th>
                  <th class="align-middle">Tahap</th>
                  <th class="align-middle">Catatan</th>
                  <th class="text-center align-middle">Aksi</th>
              </tr>
          </thead>
          <tfoot>
              <tr>
                  <th class="text-center align-middle">#</th>
                  <th class="align-middle">Nama</th>
                  <th class="align-middle">Alamat</th>
                  <th class="align-middle">No. Dokumen</th>
                  <th class="align-middle">No. Telp</th>
                  <th class="align-middle">Tahap</th>
                  <th class="align-middle">Catatan</th>
                  <th class="text-center align-middle">Aksi</th>
              </tr>
          </tfoot>
          <tbody>
            <?php
$i = 1;
foreach ($laporan as $lp): ?>
              <tr>
                  <td class="text-center align-middle"><?=$i++;?></td>
                  <td class="align-middle"><?=$lp['nama'];?></td>
                  <td class="align-middle w-25"><?=$lp['alamat'];?></td>
                  <td class="align-middle"><?=$lp['no_dok'];?></td>
                  <td class="align-middle"><?=$lp['no_telp'];?></td>
                  <td class="align-middle"><?=$lp['tahap'];?></td>
                  <td class="align-middle"><?=$lp['catatan'];?></td>
                  <td class="text-center align-middle"><a href="<?= base_url('/laporan/delete/' . $lp['id']) ?>" class="btn btn-danger d-inline-block"><i class="fas fa-trash"></i></a><hr><a href="<?= base_url('/laporan/edit/' . $lp['id']) ?>" class="btn btn-warning d-inline-block"><i class="fas fa-edit"></i></a></td>
              </tr>
            <?php endforeach;?>
          </tbody>
      </table>
  </div>
</div>
</div>
<?=$this->endSection();?>