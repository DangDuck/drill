<?=$this->extend('layout/general');?>

<?=$this->section('content');?>
<div class="row">
  <div class="col-md-6">
      <?php 
        if(session()->getFlashdata('info')):
       ?>
        <div class="alert alert-success" role="alert">
          <?=session()->getFlashdata('info');?>
        </div>
      <?php endif; ?>
      <form action="<?=base_url('home/savepass')?>" method="POST">
          <div class="form-group">
            <label for="oldPass">Password anda sekarang</label>
            <input type="password" class="form-control <?=($validation->hasError('oldPass')) ? 'is-invalid' : ''?>" id="oldPass" name="oldPass">
            <div class="invalid-feedback">
                <?=$validation->getError('oldPass');?>
            </div>
          </div>
          <div class="form-group">
            <label for="newPass">Password baru</label>
            <input type="password" class="form-control <?=($validation->hasError('newPass')) ? 'is-invalid' : ''?>" id="newPass" name="newPass">
            <div class="invalid-feedback">
                <?=$validation->getError('newPass');?>
            </div>
          </div>
          <div class="form-group">
            <label for="rePass">Ulang Password Baru</label>
            <input type="password" class="form-control <?=($validation->hasError('rePass')) ? 'is-invalid' : ''?>" id="rePass" name="rePass">
            <div class="invalid-feedback">
                <?=$validation->getError('rePass');?>
            </div>
          </div>
      <button type="submit" class="btn btn-info">Ubah</button>
    </form>
  </div>
</div>
<?=$this->endSection();?>