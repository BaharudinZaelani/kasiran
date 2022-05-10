<!-- php data -->
<?php 
use Carbon\Carbon;

$p = new Produk();
$dt = Carbon::now();
$roleAdmin = $_SESSION['admin']['role'] == 'Admin';

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
    .row.col-auto {
        grid-template-columns: repeat(auto-fill, minmax(0, 275px)) !important;
    }
    .flex {
        display: flex;
        align-items: center;
    }
    .flex .title {
        margin-left: 10px;
        margin-top: -4px;
    }
</style>

<!-- html -->
<div style="margin-bottom: 42px;">
    
    <!-- lapor -->
    <?php if($roleAdmin) : ?>
        <div class="card-wrp" style="margin-bottom: 29px;">
            <div class="row col-auto mt-1">
                <?php 
                    // product monthly 
                    $monthNow = $dt->startOfWeek()->format('Y-m');

                    // total_cost
                    $total_cost = $p->totalCost("$monthNow");

                    // pemasukan
                    $pemasukan = $p->profitCount("$monthNow");

                    // prfoit
                    $profit = $pemasukan - $total_cost;
                ?>
                <div class="card">
                    <div class="card-header">
                        <div class="flex">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box" viewBox="0 0 16 16">
                                <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5 8.186 1.113zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"/>
                            </svg>
                            <div class="title">Produk</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h1><?= $p->productCountMonthly(""); ?></h1>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="flex">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-boxes" viewBox="0 0 16 16">
                                <path d="M7.752.066a.5.5 0 0 1 .496 0l3.75 2.143a.5.5 0 0 1 .252.434v3.995l3.498 2A.5.5 0 0 1 16 9.07v4.286a.5.5 0 0 1-.252.434l-3.75 2.143a.5.5 0 0 1-.496 0l-3.502-2-3.502 2.001a.5.5 0 0 1-.496 0l-3.75-2.143A.5.5 0 0 1 0 13.357V9.071a.5.5 0 0 1 .252-.434L3.75 6.638V2.643a.5.5 0 0 1 .252-.434L7.752.066ZM4.25 7.504 1.508 9.071l2.742 1.567 2.742-1.567L4.25 7.504ZM7.5 9.933l-2.75 1.571v3.134l2.75-1.571V9.933Zm1 3.134 2.75 1.571v-3.134L8.5 9.933v3.134Zm.508-3.996 2.742 1.567 2.742-1.567-2.742-1.567-2.742 1.567Zm2.242-2.433V3.504L8.5 5.076V8.21l2.75-1.572ZM7.5 8.21V5.076L4.75 3.504v3.134L7.5 8.21ZM5.258 2.643 8 4.21l2.742-1.567L8 1.076 5.258 2.643ZM15 9.933l-2.75 1.571v3.134L15 13.067V9.933ZM3.75 14.638v-3.134L1 9.933v3.134l2.75 1.571Z"/>
                            </svg>
                            <div class="title">Stock</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h1><?= $p->stockCount(""); ?></h1>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="flex">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-graph-up-arrow" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M0 0h1v15h15v1H0V0Zm10 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V4.9l-3.613 4.417a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61L13.445 4H10.5a.5.5 0 0 1-.5-.5Z"/>
                            </svg>
                            <div class="title">Pengeluaran bulan ini</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h1>Rp <?= number_format($total_cost ,0,",","."); ?></h1>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="flex">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z"/>
                                <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z"/>
                                <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z"/>
                                <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z"/>
                            </svg>
                            <div class="title">Pemasukan bulan ini</div> 
                        </div>
                    </div>
                    <div class="card-body">
                        <h1>Rp <?= number_format($pemasukan ,0,",","."); ?></h1>
                    </div>
                </div>
                <!-- profit bersih -->
                <div class="card">
                    <div class="card-header">
                        <div class="flex">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wallet2" viewBox="0 0 16 16">
                                <path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z"/>
                            </svg>
                            <div class="title">Profit Bersih</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h1>Rp <?= ($profit > 0 ) ? number_format($profit ,0,",",".") : 0 ; ?></h1>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- showrcut -->
    <?php if( $_SESSION['admin']['role'] == 'Admin' ) : ?>

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

    <?php endif;?>
    <!-- product log -->
    <div class="row col-2 mt-1">
        
        <!-- clock -->
        <!-- <div class="card-wrp">
            <div class="card">
                <div class="card-header"></div>
                <div class="card-body">
                    <div class="clock-wrp">
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
        </div> -->

        <!-- chart -->
        <?php if( $roleAdmin ) : ?>
            <div class="card-wrp">
                <div class="card">
                    <div class="card-header">
                        <h3>Laporan Produk <?= $dt->year?></h3>
                    </div>
                    <div class="card-body">
                        <canvas id="product"></canvas>
                    </div>
                </div>
            </div>
        <?php endif;?>


        <!-- action log -->
        <div class="card-wrp <?= ($roleAdmin) ? '' : ''; ?>">
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