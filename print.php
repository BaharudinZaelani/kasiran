<?php 
include 'config.php';
session_start();
if( isset($_SESSION['print']) ){
    $hemat = $_SESSION['print']['hemat'];
    $total = $_SESSION['print']['total'];
    $bayar = $_SESSION['print']['bayar'];
    $date = $_SESSION['print']['date'];
    $id = $_SESSION['print']['trid'];
    $kasir = $_SESSION['print']['kasir'];
    $kemabli = (int)$bayar - (int)$total;
}else {
    die;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print</title>
    <style>
        bod {
            font-family: 'Times New Roman', Times, serif;
        }
        .center {
            display: grid;
            align-items: center;
            justify-content: center;
            text-align: center;
            margin-bottom: 12px;
        }
        .hr {
            border-bottom: 1px dotted #000;
        }
        th, td {
            text-align: left;
        }
        .mt-1 {
            margin-top: 12px;
        }
        .list-beli {
            width: 100%;
        }
        .harga {
            text-align: right;
        }
        .trm {
            padding: 12px;
        }
        @media print {
            #printPageButton {
                display: none;
            }
        }
    </style>
</head>
<body>
<div class="center">
    <div class="image">
        <img src="<?= LOGO; ?>" width="180">
    </div>
    <div class="info-toko">
        <span><?= ADDRESS; ?></span>
        <div>(<?= TELEPHONE; ?>)</div>
    </div>
</div>
<div class="hr"></div>
<div class="check">
    <table class="info-check">
        <tr>
            <td>No Transaksi </td>
            <td>: <?= $id; ?></td>
        </tr>
        <tr>
            <td></td>
            <td>: <?= $date; ?></td>
        </tr>
        <tr>
            <td>Kasir </td>
            <td>: <?= $kasir; ?></td>
        </tr>
    </table>
</div>
<div class="hr"></div>
<table class="mt-1 list-beli">
    <?php $i = 0; ?>
    <?php foreach( $_SESSION['chart'] as $row ) : ?>
    <?php $i++?>
        <tr>
            <td><?= $i; ?>.</td>
            <td>(<?= $row['quantity']?>) <?= $row['name']; ?></td>
            <td></td>
            <td class="harga"> <?= number_format($row['subtotal'], 0);?></td>
        </tr>
    <?php endforeach; ?>

    <!-- pembatas -->
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td class="hr"></td>
        <td class="hr"></td>
    </tr>

    <!-- hemat -->
    <tr>
        <td></td>
        <td></td>
        <td>Hemat</td>
        <td class="harga"> <?= number_format($hemat, 0); ?></td>
    </tr>
    <!-- total item -->
    <tr>
        <td></td>
        <td></td>
        <td>Total</td>
        <td class="harga"> <?= number_format($total, 0); ?></td>
    </tr>
    
    <tr>
        <td></td>
        <td></td>
        <td class="hr"></td>
        <td class="hr"></td>
    </tr>
    <!-- bayar -->
    <tr>
        <td></td>
        <td></td>
        <td>Bayar</td>
        <td class="harga"> <?= number_format($bayar, 0); ?></td>
    </tr>
    <!-- kembalian -->
    <tr>
        <td></td>
        <td></td>
        <td>Kembali</td>
        <td class="harga"> <?= number_format($kemabli, 0); ?></td>
    </tr>
</table>

<!-- terimakasih -->
<div class="hr mt-1"></div>
<div class="center">
    <div class="trm">
        Terimakasih Atas Kunjungannya
    </div>
</div>

<button id="printPageButton" onClick="window.print();">Print</button>

<script>
    // window.print();
</script>
</body>
</html>