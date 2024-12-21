<?php

class ProductsController{
    public $conn;

    public function __construct($db_connection)
    {
        $this->conn = $db_connection;
    }

    public function getProductsOnFirstLoad(){

        $getProductsQuery = "SELECT product_ID, product_cat_ID, product_name, product_actual_price, product_discounted_price, product_img_1, product_img_2, slug FROM products WHERE status = 'active' ORDER BY product_ID DESC LIMIT 24";

        $result = $this->conn->query($getProductsQuery);
        $data = [];

        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }

        return $data;

    }


}    

?>