<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4." />
  <meta name="author" content="Creative Tim" />
  <title>Boxtip | Admin</title>
  <!-- Favicon -->
  <link rel="icon" href="../template/img/brand/favicon.png" type="image/png" />
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" />
  <!-- Icons -->
  <link rel="stylesheet" href="../template/vendor/nucleo/css/nucleo.css" type="text/css" />
  <link rel="stylesheet" href="../template/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css" />
  <!-- Page plugins -->
  <!-- Argon CSS -->
  <link rel="stylesheet" href="../template/css/argon.css?v=1.2.0" type="text/css" />
  <?= $this->renderSection('link'); ?>
</head>

<body>
  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header align-items-center">
        <a class="navbar-brand" href="javascript:void(0)">
          <img src="../template/img/brand/blue.png" class="navbar-brand-img" alt="..." />
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" href="<?= base_url('admin'); ?>">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('admin/warehouse'); ?>">
                <i class="ni ni-shop text-orange"></i>
                <span class="nav-link-text">Warehouse</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('admin/eta'); ?>">
                <i class="ni ni-spaceship text-primary"></i>
                <span class="nav-link-text">ETA</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('admin/process'); ?>">
                <i class="ni ni-send text-yellow"></i>
                <span class="nav-link-text">On Process</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('admin/pickupdelivery'); ?>">
                <i class="ni ni-box-2 text-pink"></i>
                <span class="nav-link-text">Pickup/Delivery</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('admin/closed'); ?>">
                <i class="ni ni-check-bold text-info"></i>
                <span class="nav-link-text">Closed</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Navbar links -->
          <ul class="navbar-nav align-items-center ml-md-auto">
            <li class="nav-item d-xl-none">
              <!-- Sidenav toggler -->
              <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </div>
            </li>
          </ul>
          <ul class="navbar-nav align-items-center ml-auto ml-md-0">
            <li class="nav-item dropdown">
              <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media align-items-center">
                  <span class="avatar avatar-sm rounded-circle">
                    <img alt="Image placeholder" src="../template/img/theme/team-4.jpg" />
                  </span>
                  <div class="media-body ml-2 d-none d-lg-block">
                    <span class="mb-0 text-sm font-weight-bold">Admin Boxtip</span>
                  </div>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header noti-title">
                  <h6 class="text-overflow m-0">Welcome!</h6>
                </div>
                <a href="#!" class="dropdown-item">
                  <i class="ni ni-settings-gear-65"></i>
                  <span>Settings</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#!" class="dropdown-item">
                  <i class="ni ni-user-run"></i>
                  <span>Logout</span>
                </a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <?= $this->renderSection('header'); ?>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <?= $this->renderSection('content'); ?>
      <!-- Footer -->
      <footer class="footer pt-0">
        <div class="row align-items-center justify-content-lg-between">
          <div class="col-lg-6">
            <div class="copyright text-center text-lg-left text-muted">
              &copy; 2020
              <a href="#" class="font-weight-bold ml-1" target="_blank">Boxtip.id</a>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="../template/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../template/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../template/vendor/js-cookie/js.cookie.js"></script>
  <script src="../template/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="../template/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Optional JS -->
  <script src="../template/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="../template/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="../template/js/argon.js?v=1.2.0"></script>
  <!-- Custom JS -->
  <?= $this->renderSection('script'); ?>
</body>

</html>