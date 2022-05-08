<!-- php data -->
<?php 
use Carbon\Carbon;

$p = new Produk();
$dt = Carbon::now();


// setup
$januari = [
    'produk' => $p->productCountMonthly("$dt->year-01"),
    'modal' => $p->stockCount("$dt->year-01"),
];
$februari = [
    'produk' => $p->productCountMonthly("$dt->year-02"),
    'modal' => $p->stockCount("$dt->year-02"),
];
$maret = [
    'produk' => $p->productCountMonthly("$dt->year-03"),
    'modal' => $p->stockCount("$dt->year-03"),
];
$april = [
    'produk' => $p->productCountMonthly("$dt->year-04"),
    'modal' => $p->stockCount("$dt->year-04"),
];
$mei = [
    'produk' => $p->productCountMonthly("$dt->year-05"),
    'modal' => $p->stockCount("$dt->year-05"),
];
$juni = [
    'produk' => $p->productCountMonthly("$dt->year-06"),
    'modal' => $p->stockCount("$dt->year-06"),
];
$juli = [
    'produk' => $p->productCountMonthly("$dt->year-07"),
    'modal' => $p->stockCount("$dt->year-07"),
];
$agustus = [
    'produk' => $p->productCountMonthly("$dt->year-08"),
    'modal' => $p->stockCount("$dt->year-08"),
];
$september = [
    'produk' => $p->productCountMonthly("$dt->year-09"),
    'modal' => $p->stockCount("$dt->year-09"),
];
$oktober = [
    'produk' => $p->productCountMonthly("$dt->year-10"),
    'modal' => $p->stockCount("$dt->year-10"),
];
$november = [
    'produk' => $p->productCountMonthly("$dt->year-11"),
    'modal' => $p->stockCount("$dt->year-11"),
];
$desember = [
    'produk' => $p->productCountMonthly("$dt->year-12"),
    'modal' => $p->stockCount("$dt->year-12"),
];

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

    /* clock */
    .clock-wrp {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    background: #D9D7DD;
    }
    .clock {
    border-radius: 100%;
    background: #ffffff;
    font-family: "Montserrat";
    border: 5px solid white;
    box-shadow: inset 2px 3px 8px 0 rgba(0, 0, 0, 0.1);
    }

    .wrap {
    overflow: hidden;
    position: relative;
    width: 350px;
    height: 350px;
    border-radius: 100%;
    }

    .minute,
    .hour {
    position: absolute;
    height: 100px;
    width: 6px;
    margin: auto;
    top: -27%;
    left: 0;
    bottom: 0;
    right: 0;
    background: black;
    transform-origin: bottom center;
    transform: rotate(0deg);
    box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.4);
    z-index: 1;
    }

    .minute {
    position: absolute;
    height: 130px;
    width: 4px;
    top: -38%;
    left: 0;
    box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.4);
    transform: rotate(90deg);
    }

    .second {
    position: absolute;
    height: 90px;
    width: 2px;
    margin: auto;
    top: -26%;
    left: 0;
    bottom: 0;
    right: 0;
    border-radius: 4px;
    background: #FF4B3E;
    transform-origin: bottom center;
    transform: rotate(180deg);
    z-index: 1;
    }

    .dot {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    width: 12px;
    height: 12px;
    border-radius: 100px;
    background: white;
    border: 2px solid #1b1b1b;
    border-radius: 100px;
    margin: auto;
    z-index: 1;
    }

    /* s */
    .shortcut a {
        display: inline-block;
        background-color: #D9D7DD;
        opacity: 0.7;
        color: #000;
        align-items: center;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }
    .shortcut a .f-2 {
        display: flex;
        align-items: center;
    }
    .shortcut a:hover {
        opacity: 1;
    }
    .shortcut a svg {
        margin-right: 10px;
    }
</style>

<!-- html -->
<div>
    <!-- <div class="welcome">
        <div class="alert text-center">
            <h1>Welcome to <?= NAME; ?></h1>
            <br>
            <span><?= NAME; ?> | Version 1.0.0 Dev by Baharudin Zaelani</span>
        </div>
    </div> -->
    <!-- showrcut -->
    <div class="mt-1">
        <div class="card-wrp">
            <div class="card">
                <div class="card-header">
                    <h3>Shortcut</h3>
                </div>
                <div class="card-body">
                    <div class="shortcut">
                        <!-- href to add product -->
                        <a href="<?= BASE; ?>?tools=product-add">
                            <div class="f-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                </svg>
                                <span>Tambah Produk</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- product log -->
    <div class="row col-2 mt-1">
        <!-- chart -->
        <div class="card-wrp">
            <div class="card">
                <div class="card-header">
                    <h3>Laporan Produk <?= $dt->year?></h3>
                </div>
                <div class="card-body">
                    <div class="alert mb-1">
                        <canvas id="product"></canvas>
                    </div>
                    <div class="row col-2 mt-1">
                        <?php 
                            // product monthly 
                            $monthNow = $dt->startOfWeek()->format('Y-m');
                            $now = $p->productCountMonthly("$monthNow");

                            // stock monthly
                            $stockNow = $p->stockCount("$monthNow");
                        ?>
                        <div class="card">
                            <div class="card-header">
                                <h3>Produk <?= $monthNow; ?></h3>
                            </div>
                            <div class="card-body">
                                <h1>+ <?= $now; ?></h1>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3>Stock <?= $monthNow; ?></h3>
                            </div>
                            <div class="card-body">
                                <h1>+ <?= $stockNow; ?></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Clock  -->
        <div class="card-wrp">
            <div class="card">
                <div class="card-body clock-wrp">
                    <div class="clock">
                        <div class="wrap">
                            <span class="hour"></span>
                            <span class="minute"></span>
                            <span class="second"></span>
                            <span class="dot"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- action log -->
        <div class="card-wrp mt-1">
            <div class="card">
                <div class="card-header">
                    <h3>Action Log</h3>
                </div>
                <div class="card-body">
                    <div class="alert scroll-vertical" style="height: 254px;">
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

    <div class="row col-2 mt-1">
        <div class="card-wrp"></div>
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
        datasets: [
            {
                label: 'Produk ',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: [
                    <?= $januari['produk'] ?>,
                    <?= $februari['produk'] ?>,
                    <?= $maret['produk'] ?>,
                    <?= $april['produk'] ?>,
                    <?= $mei['produk'] ?>,
                    <?= $juni['produk'] ?>,
                    <?= $juli['produk'] ?>,
                    <?= $agustus['produk'] ?>,
                    <?= $september['produk'] ?>,
                    <?= $oktober['produk'] ?>,
                    <?= $november['produk'] ?>,
                    <?= $desember['produk'] ?>
                ]
            },
            {
                label: 'Stock',
                backgroundColor: 'rgb(54, 162, 235)',
                borderColor: 'rgb(54, 162, 235)',
                data: [
                    <?= $januari['modal'] ?>,
                    <?= $februari['modal'] ?>,
                    <?= $maret['modal'] ?>,
                    <?= $april['modal'] ?>,
                    <?= $mei['modal'] ?>,
                    <?= $juni['modal'] ?>,
                    <?= $juli['modal'] ?>,
                    <?= $agustus['modal'] ?>,
                    <?= $september['modal'] ?>,
                    <?= $oktober['modal'] ?>,
                    <?= $november['modal'] ?>,
                    <?= $desember['modal'] ?>
                ]
            }
        ]
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
    var inc = 1000;

    clock();

    function clock() {
        const date = new Date();

        const hours = ((date.getHours() + 11) % 12 + 1);
        const minutes = date.getMinutes();
        const seconds = date.getSeconds();
        
        const hour = hours * 30;
        const minute = minutes * 6;
        const second = seconds * 6;
        
        document.querySelector('.hour').style.transform = `rotate(${hour}deg)`
        document.querySelector('.minute').style.transform = `rotate(${minute}deg)`
        document.querySelector('.second').style.transform = `rotate(${second}deg)`
    }
    setInterval(clock, inc);
</script>