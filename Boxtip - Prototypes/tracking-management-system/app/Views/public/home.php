<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="Tracking system for Boxtip" />
  <meta name="author" content="Boxtip Development Team" />
  <title>Boxtip | Home</title>
  <!-- Favicon -->
  <link rel="icon" href="../template/img/brand/favicon.ico" />
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" />
  <!-- Icons -->
  <link rel="stylesheet" href="../template/vendor/nucleo/css/nucleo.css" type="text/css" />
  <link rel="stylesheet" href="../template/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css" />
  <!-- Argon CSS -->
  <link rel="stylesheet" href="../template/css/argon.css?v=1.2.0" type="text/css" />
</head>

<body>
  <!-- Navbar -->
  <nav id="navbar-main" class="navbar navbar-horizontal navbar-transparent navbar-main navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand" href="dashboard.html">
        <img src="../template/img/brand/white.png" />
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-collapse navbar-custom-collapse collapse" id="navbar-collapse">
        <div class="navbar-collapse-header">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="dashboard.html">
                <img src="../template/img/brand/blue.png" />
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <ul class="navbar-nav align-items-lg-center ml-lg-auto">
          <li class="nav-item">
            <a class="nav-link nav-link-icon" href="https://www.facebook.com/boxtipcn/" target="_blank" data-toggle="tooltip" data-original-title="Like us on Facebook">
              <i class="fab fa-facebook-square"></i>
              <span class="nav-link-inner--text d-lg-none">Facebook</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-link-icon" href="https://www.instagram.com/boxtip_id/" target="_blank" data-toggle="tooltip" data-original-title="Follow us on Instagram">
              <i class="fab fa-instagram"></i>
              <span class="nav-link-inner--text d-lg-none">Instagram</span>
            </a>
          </li>
          <li class="nav-item d-block ml-lg-4">
            <button type="button" class="btn btn-neutral btn-icon" data-toggle="modal" data-target="#modal-form">
              <span class="nav-link-inner--text text-warning">Login</span>
            </button>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Main content -->
  <div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-danger py-7 py-lg-8 pt-lg-9">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
              <h1 class="text-white">Selamat Datang di Boxtip.Id!</h1>
              <p class="text-lead text-white">
                Masukkan nomor resi anda untuk dilacak!
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon points="2560 0 2560 100 0 100" style="fill: #f8f9fe;"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-7">
          <div class="card bg-secondary border-0 mb-0">
            <div class="card-header bg-transparent">
              <div class="text-muted text-center">
                <small>Live Tracking System by Boxtip.id</small>
              </div>
            </div>
            <div class="card-body px-lg-5 py-lg-5">
              <div class="col">
                <div class="trackForm">
                  <form action="/home/track" method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                      <div class="input-group input-group-merge input-group-alternative">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ni ni-box-2"></i></span>
                        </div>
                        <input id="inputLacak" class="form-control  <?= ($validation->hasError('lacak') ? 'is-invalid' : '') ?>" placeholder="Nomor Resi Anda" type="text" name="lacak" value='<?= old('lacak') ?>' />
                        <div class="invalid-feedback">
                          <i class="ni ni-air-baloon p-2"></i> <?= $validation->getError('lacak'); ?>
                        </div>
                      </div>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-warning my-4">
                        Lacak
                      </button>
                    </div>
                  </form>
                </div>
                <div class="trackResultBox">
                  <?php
                  $db = \Config\Database::connect();
                  if (isset($result)) :
                    if (!empty($result)) : ?>
                      <hr>
                      <h2>Hasil pelacakan anda</h2>
                      <div class="card trackResult">
                        <div class="card-body">
                          <h5 class="card-title">
                            <?= $result['no_resi'] ?> <span class="badge badge-info badge-lg float-right"><?= $result['status'] ?></span>
                          </h5>
                          <?php
                          $status = $db->table('status')->select('deskripsi')->get()->getResultArray();
                          // dd($status);
                          $time = array_values($result);
                          // dd($time);
                          for ($i = 1; $i <= $result['status_id']; $i++) : ?>
                            <!-- loop here -->
                            <hr class="my-3">
                            <div>
                              <p class="card-text text-sm"><?= $status[$i - 1]['deskripsi'] ?></p>
                              <p class="text-light text-xs text-right m-0"><?= date('h:m, d M Y', $time[$i + 3]) ?></p>
                            </div>
                            <!-- end loop here -->
                          <?php endfor; ?>
                        </div>
                      </div>
                    <?php else : ?>
                      <hr>
                      <h2>Hasil pelacakan anda</h2>
                      <p>Nomor resi tidak ditemukan.</p>
                  <?php endif;
                  endif; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Footer -->
      <footer class="py-5" id="footer-main">
        <div class="container">
          <div class="row align-items-center justify-content-xl-between">
            <div class="col-xl-6">
              <div class="copyright text-center text-xl-left text-muted">
                &copy; 2021
                <a href='#' class="font-weight-bold ml-1 text-warning">Boxtip.id</a>
              </div>
            </div>
          </div>
        </div>
      </footer>
      <!-- Model login -->
      <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
          <div class="modal-content">
            <div class="modal-body p-0">
              <div class="card bg-secondary border-0 mb-0">
                <div class="card-header bg-transparent">
                  <div class="text-muted text-center"><small>Sign in with credentials</small></div>
                </div>
                <div class="card-body px-lg-5 py-lg-5">
                  <div class="text-muted text-center mb-4"><small>Administrator</small></div>
                  <?php if (session()->getFlashdata('info')) : ?>
                    <?php if (session()->getFlashdata('info') == 'error') : ?>
                      <div class="alert alert-danger" role="alert">
                        Username and Password invalid
                      </div>
                    <?php endif; ?>
                  <?php
                  endif; ?>
                  <form action="/user/auth" method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                      <div class="input-group input-group-merge input-group-alternative">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                        </div>
                        <input class="form-control <?= ($validation->hasError('username') ? 'is-invalid' : '') ?>" placeholder="Username" type="text" id="username" name="username" value="<?= (old('username')) ? old('username') : '' ?>">
                        <div class="invalid-feedback">
                          <i class="ni ni-air-baloon p-2"></i> <?= $validation->getError('username'); ?>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group input-group-merge input-group-alternative">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                        </div>
                        <input class="form-control <?= ($validation->hasError('password') ? 'is-invalid' : '') ?>" placeholder="Password" type="password" id="password" name="password">
                        <div class="invalid-feedback">
                          <i class="ni ni-air-baloon p-2"></i> <?= $validation->getError('password'); ?>
                        </div>
                      </div>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary my-4">Sign in</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End model login -->
      <!-- Argon Scripts -->
      <!-- Core -->
      <script src="../template/vendor/jquery/dist/jquery.min.js"></script>
      <script src="../template/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
      <script src="../template/vendor/js-cookie/js.cookie.js"></script>
      <script src="../template/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
      <script src="../template/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
      <!-- Argon JS -->
      <script src="../template/js/argon.js?v=1.2.0"></script>
</body>

</html>