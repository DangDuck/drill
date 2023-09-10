<?= $this->extend('layout/table'); ?>
<?= $this->section('content'); ?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800 font-weight-bold text-uppercase">Daftar Invoice</h1>
<div class="row mb-4">
  <div class="col-lg-8 ">
    <p>
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora, quaerat sunt. Vitae illum esse, est ratione eveniet necessitatibus officiis hic numquam eius exercitationem fugiat atque, aperiam iusto, ex omnis veritatis.
    </p>
  </div>
  <div class="col-lg-4">
    <!-- validation error -->
    <?php if ($validation->hasError('nomorInvoice')) : ?>
      <div class="alert alert-danger" role="alert">
        <?= $validation->getError('nomorInvoice'); ?>
      </div>
    <?php elseif ($validation->hasError('customerCode')) : ?>
      <div class="alert alert-danger" role="alert">
        <?= $validation->getError('customerCode'); ?>
      </div>
    <?php elseif ($validation->hasError('paymentStatus')) : ?>
      <div class="alert alert-danger" role="alert">
        <?= $validation->getError('paymentStatus'); ?>
      </div>
    <?php elseif ($validation->hasError('invoiceFile')) : ?>
      <div class="alert alert-danger" role="alert">
        <?= $validation->getError('invoiceFile'); ?>
      </div>
    <?php endif; ?>

    <!-- upload error -->
    <?php if (session()->getFlashdata('info')) : ?>
      <?php if (session()->getFlashdata('info') == 'upload_error') : ?>
        <div class="alert alert-danger" role="alert">
          File yang diupload bermasalah.
        </div>
      <?php elseif (session()->getFlashdata('info') == 'success-add') : ?>
        <div class="alert alert-success" role="alert">
          Invoice berhasil diupload.
        </div>
      <?php elseif (session()->getFlashdata('info') == 'success-edit') : ?>
        <div class="alert alert-success" role="alert">
          Invoice berhasil diupdate.
        </div>
      <?php endif; ?>
    <?php endif; ?>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary float-right btn-add" data-toggle="modal" data-target="#staticBackdrop">
      Upload Invoice
    </button>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title font-weight-bold" id="staticBackdropLabel">UPLOAD INVOICE</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="<?= base_url('/master/uploadInvoice') ?>" method="POST" enctype="multipart/form-data">
              <input type="hidden" id="nomorInvoiceLama" name="nomorInvoiceLama">
              <div class="form-group">
                <label for="nomorInvoice">Nomor Invoice</label>
                <input type="text" class="form-control" id="nomorInvoice" name="nomorInvoice" placeholder="INV-YYYYMMDD-BX000-000">
                </select>
              </div>
              <div class="form-group">
                <label for="customerCode">Customer Code</label>
                <select class="form-control" id="customerCode" name="customerCode">
                  <option selected disabled>Select Customer</option>
                  <?php foreach ($customer_code as $cs_code) : ?>
                    <option value="<?= $cs_code['id'] .
                                      '-' . $cs_code['customer_code'] ?>" <?= (old('customerCode') == $cs_code['customer_code']) ? 'selected' : '' ?>><?= $cs_code['customer_code'] ?> - <?= $cs_code['nama'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group">
                <label for="paymentStatus">Payment Status</label>
                <select class="form-control" id="paymentStatus" name="paymentStatus">
                  <option selected disabled>Select Payment Status</option>
                  <?php foreach ($status as $st) : ?>
                    <option value="<?= $st['id'] ?>" <?= (old('paymentStatus') == $st['id']) ? 'selected' : '' ?>><?= $st['status'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group">
                <label for="invoiceFile">Upload Invoice</label>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="invoiceFile" name="invoiceFile">
                  <label class="custom-file-label" for="invoiceFile" id="labelFileInvoice">Upload file</label>
                </div>
              </div>
              <div class="modal-footer px-0">
                <button type="button" class="btn btn-light border border-danger text-danger" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger btn-submit">Upload</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- DataTables Invoice -->
<div class="card shadow mb-4">
  <div class="card-header py-3" style="background-color: #FFF6F6;">
    <h6 class="m-0 font-weight-bold text-danger">
      Daftar Invoice
    </h6>
  </div>
  <div class="card-body text-xs">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>#</th>
            <th>Invoice No.</th>
            <th>Customer Code</th>
            <th>Last Update</th>
            <th>Payment Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>#</th>
            <th>Invoice No.</th>
            <th>Customer Code</th>
            <th>Last Update</th>
            <th>Payment Status</th>
            <th>Action</th>
          </tr>
        </tfoot>
        <tbody>
          <?php
          $i = 1;
          foreach ($invoice as $inv) :
          ?>
            <tr>
              <td class="align-middle text-center"><?= $i++; ?></td>
              <td class="align-middle" style="width:22%;"><?= $inv['nomor_invoice'] ?></td>
              <td class="align-middle"><?= $inv['customer_code'] ?></td>
              <td class="align-middle"><?= ($inv['updated_at'] == "0000-00-00 00:00:00") ? $inv['created_at'] : $inv['updated_at'] ?></td>
              <td class="align-middle"><span class="p-1 rounded text-light d-inline-block w-100 text-center <?= ($inv['status'] == "FULL PAYMENT" ? "bg-success" : "bg-warning") ?>"><?= $inv['status'] ?></span></td>
              <td class="align-middle text-center"><button class="btn btn-info btn-sm btn-edit text-xs" data-id="<?= $inv['nomor_invoice'] ?>" data-toggle="modal" data-target="#staticBackdrop">Update</button> | <a href="<?= base_url('/master/deleteinvoice' . '/' . $inv['nomor_invoice']) ?>" class="btn btn-warning btn-sm btn-edit  text-xs" onclick="return confirm('Hapus data invoice ini?')">Delete</a></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

  <div class="card-body pt-0 text-xs">
    <h6 class="p font-weight-bold text-xs">NOTES:</h6>
    <div class="row">
      <div class="col">
        <?php foreach ($status as $st) : ?>
          <p><span style="width: 100px;" class="p-1 rounded text-light d-inline-block text-center <?= ($st['status'] == "FULL PAYMENT" ? "bg-success" : "bg-warning") ?>"><?= $st['status'] ?></span> - <?= $st['keterangan'] ?></p>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>