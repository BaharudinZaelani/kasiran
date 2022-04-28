<!-- php data -->
<?php 
use Carbon\Carbon as time; 
$file = new Fileuploader();
if( isset($_POST['tambah']) ) {

    $name = $_POST['name'];
    $type = $_POST['type'];
    $category = $_POST['category'];
    $quantity = $_POST['quantity'];
    $tax = $_POST['tax'];
    $method = $_POST['method'];
    $cost = $_POST['cost'];
    $price = $_POST['price'];
    $created = time::now();

    // upload file
    $upload = $file->uploadImage($_FILES['image']['name'], $_FILES['image']['type'], $_FILES['image']['size'], $_FILES['image']['tmp_name']);
    $image = $upload['to'];

    $query = "INSERT INTO product (name, image, type, category, quantity, tax, method, cost, price, created_at, updated_at) VALUES ('$name', '$image', '$type', '$category', '$quantity', '$tax', '$method', '$cost', '$price', '$created', NULL)";
    $db->query($query);
    if( $db->execute() AND $upload['status'] ) {
        echo '<script>
            Swal.fire({
                title: "Success!",
                text: "Data berhasil ditambahkan",
                icon: "success",
                confirmButtonText: "OKE !",
                confirmButtonColor: "#2b982b"
            })
        </script>';
    } else {
        echo '<script>
            Swal.fire({
                title: "Failed!",
                text: "Data gagal ditambahkan",
                icon: "error",
                confirmButtonText: "OKE !",
                confirmButtonColor: "#2b982b"
            })
        </script>';
    }
}

?>
<!-- scoped style -->
<style>
    
</style>
<!-- html -->
<div>
    <div class="card-wrp">
        <div class="card">
            <div class="card-header">
                <h3>Tambah Produk</h3>
            </div>
            <form method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <!-- baris 1 -->
                    <div class="row col-2">
                        <div class="input-group">
                            <label for="name">Nama Produk</label>
                            <input type="text" id="name" name="name">
                        </div>
                        <div class="input-group">
                            <label for="image">Image</label>
                            <input type="file" id="image" name="image">
                        </div>
                    </div>

                    <!-- baris 2 -->
                    <div class="row col-2">
                        <div class="input-group">
                            <label for="type">type</label>
                            <select name="type" id="type">
                                <option value="1">Standard</option>
                            </select>
                        </div>
                    </div>

                    <!-- baris 3 -->
                    <div class="row col-2">
                        <div class="input-group">
                            <label for="category">Kategory</label>
                            <select name="category" id="category">
                                <option value="1">General</option>
                            </select>
                        </div>
                    </div>

                    <!-- baris 4 -->
                    <div class="row col-2">
                        <div class="input-group">
                            <label for="quantity">Stok</label>
                            <input type="number" id="quantity" max="999" min="0" name="quantity" value="0">
                        </div>
                    </div>

                    <!-- baris 5 -->
                    <div class="row col-2">
                        <div class="input-group">
                            <label for="tax">tax</label>
                            <input type="number" id="tax" max="999999" min="0" name="tax" value="0">
                        </div>
                    </div>

                    <!-- baris 5 -->
                    <div class="row col-2">
                        <div class="input-group">
                            <label for="method">Method</label>
                            <select name="method" id="method">
                                <option value="Cash">Cash</option>
                                <option value="Debit">Debit</option>
                                <option value="Credit">Credit</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- baris 6 -->
                    <div class="row col-2">
                        <div class="input-group">
                            <label for="price">Harga Beli</label>
                            <input type="number" id="price" max="999999" min="0" name="cost" value="0">
                        </div>
                    </div>

                    <!-- baris 5 -->
                    <div class="row col-2">
                        <div class="input-group">
                            <label for="priceb">Harga Jual</label>
                            <input type="number" id="priceb" max="999999" min="0" name="price" value="0">
                        </div>
                    </div>
                    
                    <div class="input-submit">
                        <button class="success" name="tambah">SUBMIT</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>