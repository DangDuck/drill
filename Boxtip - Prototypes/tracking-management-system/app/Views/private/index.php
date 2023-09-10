<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="Tracking system for Boxtip" />
  <meta name="author" content="Boxtip Development Team" />
  <title>Boxtip | Admin</title>
  <!-- Favicon -->
  <link rel="icon" href="../template/img/brand/favicon.ico" />
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" />
  <!-- Icons -->
  <link rel="stylesheet" href="../template/vendor/nucleo/css/nucleo.css" type="text/css" />
  <link rel="stylesheet" href="../template/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css" />
  <!-- Argon CSS -->
  <link rel="stylesheet" href="../template/css/argon.css?v=1.2.0" type="text/css" />
  <!-- Custom styles for this page -->
  <link href="../template/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body>
  <!-- Navbar -->
  <nav id="navbar-main" class="navbar navbar-horizontal navbar-transparent navbar-main navbar-expand-lg navbar-light">
    <div class="container py-3">
      <a class="navbar-brand py-2" href="dashboard.html">
        <img src="../template/img/brand/white.png" />
      </a>
      <a href="<?= base_url('user/logout') ?>" class="btn btn-outline-light">Logout</a>
    </div>
  </nav>

  <!-- Main content -->
  <div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-default py-7 py-lg-8 pt-lg-9">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-9 col-md-10 px-5">
              <h1 class="text-white">Input and Update</h1>
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
        <div class="col-xl-6 col-lg-7 col-md-8">
          <div class="nav-wrapper">
            <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-manualrole=" tablist">
              <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-import-tab" data-toggle="tab" href="#tabs-import" role="tab" aria-controls="tabs-import" aria-selected="true"><i class="ni ni-cloud-upload-96 mr-2"></i>Import</a>
              </li>
              <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-manual-tab" data-toggle="tab" href="#tabs-manual" role="tab" aria-controls="tabs-manual" aria-selected="false"><i class="ni ni-bell-55 mr-2"></i>Manual</a>
              </li>
            </ul>
          </div>
          <?php if (session()->getFlashdata('duplicate')) : ?>
            <div class="alert alert-warning" role="alert">
              <strong><?= session()->getFlashdata('duplicate') ?>!</strong> Nomor resi ini duplikat
            </div>
          <?php endif; ?>
          <?php if (session()->getFlashdata('skipped')) : ?>
            <div class="alert alert-warning" role="alert">
              <strong><?= session()->getFlashdata('skipped') ?>!</strong> Nomor resi ini belum diinput/update status sebelumnya
            </div>
          <?php endif; ?>
          <div class="card shadow">
            <div class="card-body">
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="tabs-import" role="tabpanel" aria-labelledby="tabs-import-tab">
                  <form action="/admin/import" enctype="multipart/form-data" method="POST" class="text-sm">
                    <div class="form-group">
                      <label class="form-control-label mb-3">Status</label>
                      <select class="form-control mb-3" name="statusImport">
                        <option value="1">Warehouse</option>
                        <option value="2">ETA</option>
                        <option value="3">On Process</option>
                        <option value="4">Pickup/Delivery</option>
                        <option value="5">Closed</option>
                      </select>
                    </div>
                    <hr>
                    <div class="form-group">
                      <label class="form-control-label mb-3">Excel File (.xls or .xlsx)</label>
                      <div class="custom-file text-sm">
                        <input type="file" class="custom-file-input <?= ($validation->hasError('import')) ? 'is-invalid' : '' ?>" id="import" lang="en" name="import">
                        <label class="custom-file-label" for="import">Select file</label>
                        <div class="invalid-feedback">
                          <i class="ni ni-air-baloon p-2"></i> <?= $validation->getError('import'); ?>
                        </div>
                      </div>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary my-4">Upload</button>
                    </div>
                  </form>
                </div>
                <!-- Tab manual -->
                <div class="tab-pane fade" id="tabs-manual" role="tabpanel" aria-labelledby="tabs-manual-tab">
                  <form action="/admin/manual" method="POST" enctype="multipart/form-data" class=" text-sm">
                    <div class="form-group mb-3">
                      <label class="form-control-label mb-3">Status</label>
                      <select class="form-control mb-3" name="statusManual">
                        <option value="1">Warehouse</option>
                        <option value="2">ETA</option>
                        <option value="3">On Process</option>
                        <option value="4">Pickup/Delivery</option>
                        <option value="5">Closed</option>
                      </select>
                    </div>
                    <hr>
                    <div class="form-group">
                      <label class="form-control-label mb-3" for="manual">Input for Warehouse Status</label>
                      <textarea class="form-control <?= ($validation->hasError('manual') ? 'is-invalid' : '') ?>" id="manual" rows="5" name="manual" style="resize: none;"></textarea>
                      <div class="invalid-feedback">
                        <i class="ni ni-air-baloon p-2"></i> <?= $validation->getError('manual'); ?>
                      </div>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary my-4">Save</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <!-- DataTables -->
          <div class="card">
            <div class="card-header bg-transparent border-0">
              <h3 class="mb-3">Table</h3>
              <?php if (session()->getFlashdata('info')) : ?>
                <div class="alert <?= (session()->getFlashdata('info') == 'success') ? 'alert-success' : 'alert-danger' ?> alert-dismissible fade show" role="alert">
                  <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                  <span class="alert-text"><strong><?= (session()->getFlashdata('info') == 'success') ? 'Success</strong>! Data updated!' : 'Failed!' ?></span>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              <?php endif; ?>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-flush" id="dataTable" width="100%" cellspacing="0">
                  <thead class="thead-light">
                    <tr>
                      <th>#</th>
                      <th>Nomor Resi</th>
                      <th>Status</th>
                      <th>On Warehouse</th>
                      <th>On ETA</th>
                      <th>On Process</th>
                      <th>On Pickup/Delivery</th>
                      <th>On Closed</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot class="text-uppercase">
                    <tr>
                      <th>#</th>
                      <th>Nomor Resi</th>
                      <th>Status</th>
                      <th>On Warehouse</th>
                      <th>On ETA</th>
                      <th>On Process</th>
                      <th>On Pickup/Delivery</th>
                      <th>On Closed</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody class="list">
                    <?php $i = 1;
                    foreach ($resi as $r) : ?>
                      <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $r['no_resi']; ?></td>
                        <td><?= $r['status'] ?></td>
                        <td><?= ($r['warehouse_at'] != 0) ? date('D, d M Y ', $r['warehouse_at']) : 'Not Yet'  ?></td>
                        <td><?= ($r['eta_at'] != 0) ? date('D, d M Y ', $r['eta_at']) : 'Not Yet'  ?></td>
                        <td><?= ($r['process_at'] != 0) ? date('D, d M Y ', $r['process_at']) : 'Not Yet'  ?></td>
                        <td><?= ($r['delivery_at'] != 0) ? date('D, d M Y ', $r['delivery_at']) : 'Not Yet'  ?></td>
                        <td><?= ($r['closed_at'] != 0) ? date('D, d M Y ', $r['closed_at']) : 'Not Yet'  ?></td>
                        <td><button class="btn btn-warning btn-sm btn-edit" data-toggle="modal" data-target="#modal-form" data-id="<?= $r['id'] ?>"><i class="ni ni-ruler-pencil align-middle"></i></button> <a href="<?= base_url('admin/delete') . '/' . $r['id'] ?>" class="btn btn-danger btn-sm text-white"><i class="ni ni-fat-remove align-middle"></i></a></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal Edit Resi -->
      <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
          <div class="modal-content">
            <div class="modal-body p-0">
              <div class="card bg-secondary border-0 mb-0">
                <div class="card-header bg-transparent">
                  <div class="text-muted text-center"><small>Edit Nomor Resi</small></div>
                </div>
                <div class="card-body px-lg-5 py-lg-5">
                  <div class="text-muted text-center mb-4"><small>Nomor Resi</small></div>
                  <form action="/admin/update" method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                      <div class="input-group input-group-merge input-group-alternative">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                        </div>
                        <input type="hidden" id="idResi" name="idResi" value="">
                        <input class="form-control px-2 <?= ($validation->hasError('resi') ? 'is-invalid' : '') ?>" placeholder="Nomor Resi" type="text" id="resi" name="resi" value="<?= (old('resi')) ? old('resi') : '' ?>">
                        <div class="invalid-feedback">
                          <i class="ni ni-air-baloon p-2"></i> <?= $validation->getError('resi'); ?>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group input-group-merge input-group-alternative">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                        </div>
                        <input class="form-control px-2" placeholder="Status" type="text" id="status" disabled>
                        <div class="invalid-feedback">
                          <i class="ni ni-air-baloon p-2"></i> <?= $validation->getError('status'); ?>
                        </div>
                      </div>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary my-4">Save</button>
                    </div>
                  </form>
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
                <a href='#' class="font-weight-bold ml-1 text-primary">Boxtip.id</a>
              </div>
            </div>
          </div>
        </div>
      </footer>
      <!-- Argon Scripts -->
      <!-- Core -->
      <script src="../template/vendor/jquery/dist/jquery.min.js"></script>
      <script src="../template/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
      <script src="../template/vendor/js-cookie/js.cookie.js"></script>
      <script src="../template/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
      <script src="../template/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
      <!-- Argon JS -->
      <script src="../template/js/argon.js?v=1.2.0"></script><?= $this->section('script'); ?>
      <!-- Page level plugins -->
      <script src="../template/datatables/jquery.dataTables.min.js"></script>
      <script src="../template/datatables/dataTables.bootstrap4.min.js"></script>
      <script src="../template/datatables/datatables-demo.js"></script>
      <!-- Custom JS -->
      <script>
        $(".btn-edit").on('click', function() {
          $.ajax({
            url: "/admin/getResi",
            method: 'POST',
            dataType: "json",
            data: {
              id: $(this).data('id'),
            },
            success: function(result) {
              console.log(result);
              $('#resi').val(result.no_resi);
              $('#status').val(result.status);
              $('#idResi').val(result.id);
            }
          })
        })
      </script>
</body>

</html>