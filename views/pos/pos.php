<!-- php data -->
<?php 
$total = 0;
$tax = 0;

// gett all product
if( isset($_POST['search-btn']) ){
    $search = $_POST['search'];
    $queryP = "SELECT * FROM product WHERE name LIKE '%$search%'";
}else {
    $queryP = "SELECT * FROM product";
}
$db->query($queryP);
$products = $db->resultset();


// create a session chart
if( !isset($_SESSION['chart']) ){
    $_SESSION['chart'] = array();
}

// add chart to session
if( isset($_POST['item']) ){
    $id = $_POST['id'];
    $item = $_POST['item'];
    $price = $_POST['price'];
    $name = $_POST['name'];
    $tax = $_POST['tax'];

    // check if product is already in chart
    $check = false;
    if( $_SESSION['chart'] == [] ){
        array_push($_SESSION['chart'], [
            'id' => $id,
            'item' => $item,
            'price' => $price,
            'quantity' => 1,
            'name' => $name,
            'tax' => $tax
        ]);
    }else {
        foreach( $_SESSION['chart'] as $key => $value ){
            if( $value['id'] == $id ){
                $check = false;
                $_SESSION['chart'][$key]['quantity'] += 1;
            }else {
                $check = true;
            }
        }
    }

    if( $check ){
        array_push($_SESSION['chart'], [
            'id' => $id,
            'item' => $item,
            'price' => $price,
            'quantity' => 1,
            'name' => $name,
            'tax' => $tax
        ]);
    }

}

// clear session chart
if( isset($_POST['clear-chart']) ){
    $_SESSION['chart'] = array();
}

// var_dump($_SESSION['chart']);

?>
<style>
    .row {
        display: grid;
        grid-gap: 12px;
    }
    .col-2-3 {
        grid-template-columns: 1fr 1.3fr !important;
    }
    .card-body {
        height: 86vh !important;
        overflow: auto;
    }
    .items:hover {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
    .items-info {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: start;
        text-align: left;
        padding: 5px;
    }
    .items {
        border: none;
        background-color: #fff !important;
        color: #000;
        cursor: pointer;
    }
    .items h5 {
        font-size: 14px;
    }
    .kasir-info {
        display: grid;
        justify-content: space-between;
        align-items: center;
        grid-template-columns: 1fr 3fr;
        height: 80px;
    }
    .image {
        opacity: 0.7;
        display: flex;
        justify-content: center;
        align-items: center;
        width: auto;
        transform: scale(3);
    }
    .chart button {
        border-radius: 0 !important;
    }
    .col-auto {
        grid-template-columns: repeat(auto-fill, minmax(0, 150px)) !important;
    }
    .card-body {
        background-color: <?= BG_COLOR_FOURTH ?> !important;
    }
    .card {
        box-shadow: none !important;
    }
</style>
<div class="row col-2-3">
    <div class="card-wrp">
        <div class="card">
            <div class="card-body">
                <!-- row1 -->
                <form method="post">
                    <div class="row ">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Cari Produk" id="search">
                            <button name="search-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </form>

                <!-- kasir info -->
                <div class="kasir-info">
                    <div class="image">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-workspace" viewBox="0 0 16 16">
                            <path d="M4 16s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H4Zm4-5.95a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                            <path d="M2 1a2 2 0 0 0-2 2v9.5A1.5 1.5 0 0 0 1.5 14h.653a5.373 5.373 0 0 1 1.066-2H1V3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v9h-2.219c.554.654.89 1.373 1.066 2h.653a1.5 1.5 0 0 0 1.5-1.5V3a2 2 0 0 0-2-2H2Z"/>
                        </svg>
                    </div>
                    <div class="name">
                        <h3><?= $_SESSION['admin']['name']?></h3>
                        <span><?= $_SESSION['admin']['role']?></span>
                    </div>
                </div>

                <!-- tabel chart -->
                <div class="chart">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Nama</th>
                                <th scope="col">Harga</th>
                                <th>TAX</th>
                                <th scope="col">Quantity</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // tax = (total * 10) / 100
                            foreach( $_SESSION['chart'] as $key => $value ){
                                $subtotal = $value['price'] * $value['quantity'];
                                $total += $subtotal;
                                $subtotal = number_format($subtotal, 0, ',', '.');
                                ?>
                                <tr>
                                    <td><?= $value['name'];?></td>
                                    <td><?= number_format($value['price'], 0); ?></td>
                                    <td><?= $value['tax'];?>%</td>
                                    <td class="quantity">
                                        <input type="number" name="quantity" value="<?= $value['quantity'];?>" min="1" max="100"/>
                                    </td>
                                    <td class="text-right"><?= $subtotal; ?></td>
                                </tr>
                            <?php } 
                                $taxResult = ($total * $tax) / 100;
                            ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <th>TAX</th>
                                <th class="text-right"><?= number_format($taxResult, 0)?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <th>Total</th>
                                <th class="text-right"><?= number_format($total, 0) ?></th>
                            </tr>
                        </tbody>
                    </table>
                    <div class="input-submit">
                        <form method="post">
                            <button type="submit" name="clear-chart" class="danger" name="clear-chart">Clear Chart</button>
                        </form>    
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-wrp">
        <div class="card">
            <div class="card-body">

                <div class="list-products">
                    <div class="row col-auto">
                        <?php foreach ($products as $p) : ?>

                            <form method="post">

                                <input type="text" name="id" hidden value="<?= $p['id']?>">
                                <input type="text" name="name" hidden value="<?= $p['name']?>">
                                <input type="text" name="tax" hidden value="<?= $p['tax']?>">
                                <input type="text" name="price" hidden value="<?= $p['price']?>">
                                <input type="text" name="quantity" hidden value="1">
                                <button name="item" class="items">
                                    <img src="<?= $p['image']?>" width="150" height="150">
                                    <div class="items-info">
                                        <h5><?= $p['name']?></h5>
                                        <p>Rp <?= number_format($p['price'], 0)?></p>
                                    </div>
                                </button>

                            </form>

                        <?php endforeach; ?>
                    </div>
                </div>
            
            </div>
        </div>
    </div>
</div>