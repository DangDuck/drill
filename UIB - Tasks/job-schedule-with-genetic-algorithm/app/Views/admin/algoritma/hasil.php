<?= $this->extend('templates/template_admin'); ?>
<?= $this->section('content'); ?>
<div class="card">
  <div class="card-header">
    <h3 class="card-title"><?= $title; ?></h3>
  </div>
  <!-- /.card-header -->
  <div class=" card-body">
    <p>Total Waktu yang dibutuhkan: <?php print_r($population[1]) ?></p>
    <p>Terbentuk pada generasi ke: <?php print_r($population[2]) ?></p>
    <h6>Jadwal Mesin Terbaik: </h6>
    <div class="card">
      <div class="card-body p-0">
        <table class="table table-sm">
          <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th>Mesin</th>
              <th>Pekerjaan</th>
              <th>Proses</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // echo '[';
            // foreach ($population[0] as $d) {
            //   echo $d . ',';
            // }
            // echo ']';
            $i = 1;
            $counter = [];
            $pekerjaanLineModel = new \App\Models\PekerjaanLineModel();
            foreach ($population[0] as $d) {
              $counts = array_count_values($counter);
              if (in_array($d, $counter)) {
                $sequence = $counts[$d] + 1;
              } else {
                $sequence = 1;
              }
              $line = $pekerjaanLineModel->get_html_data($d, $sequence);
            ?>
              <tr>
                <td><?= $i; ?></td>
                <td><?= $line['mesin_id']; ?></td>
                <td><?= $line['pekerjaan_id']; ?></td>
                <td><?= $line['proses_id']; ?></td>
              </tr>
            <?php
              $counter[] = $d;
              $i++;
            }; ?>
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
  </div>
  <!-- /.card-body -->
</div>
<?= $this->endSection(); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js" integrity="sha512-TW5s0IT/IppJtu76UbysrBH9Hy/5X41OTAbQuffZFU6lQ1rdcLHzpU5BzVvr/YFykoiMYZVWlr/PX1mDcfM9Qg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>