<!-- php data -->
<?php 
use Carbon\Carbon;
// setup
$dt = Carbon::now();
$januari = 0;
$februari = 0;
$maret = 0;
$april = 0;
$mei = 0;
$juni = 0;
$juli = 0;
$agustus = 0;
$september = 0;
$oktober = 0;
$november = 0;
$desember = 0;

// january
$query = "SELECT * FROM product WHERE created_at LIKE '%$dt->year". "-" . "01%'";
$db->query($query);
$db->execute();
$data = $db->resultSet();
foreach ($data as $key => $value) {
    $januari += 1;
}

// february
$query = "SELECT * FROM product WHERE created_at LIKE '%$dt->year". "-" . "02%'";
$db->query($query);
$db->execute();
$data = $db->resultSet();
foreach ($data as $key => $value) {
    $februari += 1;
}

// maret
$query = "SELECT * FROM product WHERE created_at LIKE '%$dt->year". "-" . "03%'";
$db->query($query);
$db->execute();
$data = $db->resultSet();
foreach ($data as $key => $value) {
    $maret += 1;
}

// april
$query = "SELECT * FROM product WHERE created_at LIKE '%$dt->year". "-" . "04%'";
$db->query($query);
$db->execute();
$data = $db->resultSet();
foreach ($data as $key => $value) {
    $april += 1;
}

// mei
$query = "SELECT * FROM product WHERE created_at LIKE '%$dt->year". "-" . "05%'";
$db->query($query);
$db->execute();
$data = $db->resultSet();
foreach ($data as $key => $value) {
    $mei += 1;
}

// juni
$query = "SELECT * FROM product WHERE created_at LIKE '%$dt->year". "-" . "06%'";
$db->query($query);
$db->execute();
$data = $db->resultSet();
foreach ($data as $key => $value) {
    $juni += 1;
}

// juli
$query = "SELECT * FROM product WHERE created_at LIKE '%$dt->year". "-" . "07%'";
$db->query($query);
$db->execute();
$data = $db->resultSet();
foreach ($data as $key => $value) {
    $juli += 1;
}

// agustus
$query = "SELECT * FROM product WHERE created_at LIKE '%$dt->year". "-" . "08%'";
$db->query($query);
$db->execute();
$data = $db->resultSet();
foreach ($data as $key => $value) {
    $agustus += 1;
}

// september
$query = "SELECT * FROM product WHERE created_at LIKE '%$dt->year". "-" . "09%'";
$db->query($query);
$db->execute();
$data = $db->resultSet();
foreach ($data as $key => $value) {
    $september += 1;
}

// oktober
$query = "SELECT * FROM product WHERE created_at LIKE '%$dt->year". "-" . "10%'";
$db->query($query);
$db->execute();
$data = $db->resultSet();
foreach ($data as $key => $value) {
    $oktober += 1;
}

// november
$query = "SELECT * FROM product WHERE created_at LIKE '%$dt->year". "-" . "11%'";
$db->query($query);
$db->execute();
$data = $db->resultSet();
foreach ($data as $key => $value) {
    $november += 1;
}

// desember
$query = "SELECT * FROM product WHERE created_at LIKE '%$dt->year". "-" . "12%'";
$db->query($query);
$db->execute();
$data = $db->resultSet();
foreach ($data as $key => $value) {
    $desember += 1;
}


?>
<!-- scoped style -->
<style>
    .table {
        width: 100%;
        border-collapse: collapse;
    }
    .table th, .table td {
        text-align: left;
        border: 1px solid #ddd;
        padding: 8px;
    }
</style>
<!-- html -->
<div>
    <div class="welcome">
        <div class="alert text-center">
            <h1>Welcome to <?= NAME; ?></h1>
            <br>
            <span><?= NAME; ?> | Version 1.0.0 Dev by Baharudin Zaelani</span>
        </div>
    </div>
    <div class="row col-2 mt-1">
        <!-- chart -->
        <div class="card-wrp">
            <div class="card">
                <div class="card-header">
                    <h3>Product Chart <?= $dt->year?></h3>
                </div>
                <div class="card-body">
                    <div class="alert">
                        <canvas id="product"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- action log -->
        <div class="card-wrp">
            <div class="card">
                <div class="card-header">
                    <h3>Action Log</h3>
                </div>
                <div class="card-body">
                    <div class="alert">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>User</th>
                                    <th>Action</th>
                                    <th>Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $query = "SELECT * FROM action_log WHERE `action` LIKE '%produk%' ORDER BY id DESC LIMIT 10";
                                $db->query($query);
                                $db->execute();
                                $data = $db->resultSet();
                                $no = 1;
                                foreach ($data as $key => $value) {
                                    ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $value['user']; ?></td>
                                        <td><?= $value['action']; ?></td>
                                        <td><?= $value['created_at']; ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const labels = [
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
    'July',
    'August',
    'September',
    'October',
    'November',
    'December'
  ];

  const data = {
    labels: labels,
    datasets: [{
      label: 'Produk Bertambah',
      backgroundColor: 'rgb(255, 99, 132)',
      borderColor: 'rgb(255, 99, 132)',
      data: [
        <?= $januari ?>,
        <?= $februari ?>,
        <?= $maret ?>,
        <?= $april ?>,
        <?= $mei ?>,
        <?= $juni ?>,
        <?= $juli ?>,
        <?= $agustus ?>,
        <?= $september ?>,
        <?= $oktober ?>,
        <?= $november ?>,
        <?= $desember ?>
      ]
    }]
  };

  const config = {
    type: 'line',
    data: data,
    options: {}
  };
  const product = new Chart(
    document.getElementById('product'),
    config
  );
</script>