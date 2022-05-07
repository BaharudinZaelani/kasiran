<?php 

class Produk {
    private $show = PRODUCT_SHOW;
    private $page = PRODUCT_PAGE;
    private $file = 'config.php';

    // count cost
    public function cost($price, $quantity) {
        return $price * $quantity;
    }

    // setter & getter show,page
    public function setShow($show) {
        global $app;
        $content = file_get_contents($this->file);
        $cc = '$show = ' . PRODUCT_SHOW . ';';
        if( strpos($content, $cc) !== false ){
            file_put_contents($this->file,str_replace($cc, '$show = ' . $show . ';', file_get_contents($this->file)));
        }
        $app->redirect('?tools=product-list');
    }
    public function getShow() {
        return $this->show;
    }
    public function setPage($page_count) {
        global $app;
        $content = file_get_contents($this->file);
        $cc = '$page = ' . PRODUCT_PAGE . ';';
        if( strpos($content, $cc) !== false ){
            file_put_contents($this->file,str_replace($cc, '$page = ' . $page_count . ';', file_get_contents($this->file)));
        }
        // var_dump($cc);
        // die;
        $app->redirect('?tools=product-list');
    }
    public function getPage() {
        return $this->page;
    }

    // return a qury string
    public function queryString() {
        $query = "";

        if( $this->page > 1 ) {
            $query .= " LIMIT " . ($this->page - 1) * $this->show . ", " . $this->show;
        }else {
            $query .= " LIMIT 0, " . $this->show;
        }
        return "SELECT * FROM product ORDER BY id DESC " . $query;
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