<?php 

class Produk {
    
    // count cost
    public function cost($price, $quantity) {
        return $price * $quantity;
    }

    // count profit
    public function profit($price, $quantity) {
        return $price * $quantity;
    }

    // monthly add product
    public function productCountMonthly($date){
        global $db;
        $query = "SELECT * FROM product WHERE created_at LIKE '%$date%'";
        $db->query($query);
        $db->execute();
        $produk = $db->resultSet();
        $count = 0;
        foreach($produk as $p){
            $count += 1;
        }

        return $count;
    }

    // count all stock from date
    public function stockCount($date){
        global $db;
        $query = "SELECT * FROM product WHERE created_at LIKE '%$date%'";
        $db->query($query);
        $db->execute();
        $produk = $db->resultSet();
        $count = 0;
        foreach($produk as $p){
            $count += $p['quantity'];
        }
        return $count;
    }

}