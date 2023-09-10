<?= $this->extend('layout/general'); ?>
<?= $this->section('content'); ?>
<div class="jumbotron">
  <h1 class="display-4 font-weight-bold text-gray-900 text-center">Hello, <?= session()->get('nama') ?>!</h1>
  <p class="lead font-weight-bold text-gray-900 text-center">Thanks for trusting us as your Taobao Shopping Agent</p>
  <hr class="my-4">
  <div class="container-video">
    <iframe src="https://www.youtube.com/embed/QTpGnX4b39w" frameborder="0" allowfullscreen class="video"></iframe>
  </div>
  <h4 class="font-weight-bold text-gray-900 text-center mt-5">We will provide you with our best services to satisfy you</h4>
</div>
<?= $this->endSection(); ?>