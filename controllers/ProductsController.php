<?php

class ProductsController
{
    public $conn;

    public function __construct($db_connection)
    {
        $this->conn = $db_connection;
    }

    public function getProductsOnFirstLoad()
    {
        if(isset($_GET['product-category']) && $_GET['product-category'] == 'Polyester_cotton'){
            return $this->polyCottonTrousers(24);
        }

        $getProductsQuery = "SELECT product_ID, product_cat_ID, product_name, product_actual_price, product_discounted_price, product_img_1, product_img_2, slug FROM products WHERE status = 'active' ORDER BY product_ID DESC LIMIT 24";

        $data = [];

        try {
            $result = $this->conn->query($getProductsQuery);

            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
                return $data;
            }
        } catch (Exception | Error $e) {
            echo "<script>console.log('Error in getProductsOnFirstLoad: " . $e->getMessage() . "')</script>";
            return null;
        }
    }


    public function newArrivalProducts()
    {
        $newArrivalProductsQuery = "SELECT product_ID, product_cat_ID, product_name, product_actual_price, product_discounted_price, product_img_1, product_img_2, slug FROM products WHERE status = 'active' ORDER BY product_ID DESC LIMIT 8";

        $data = [];

        try {
            $result = $this->conn->query($newArrivalProductsQuery);

            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
                return $data;
            }
        } catch (Exception | Error $e) {
            echo "<script>console.log('Error in newArrivalProducts: " . $e->getMessage() . "')</script>";
            return null;
        }
    }

    public function polyCottonTrousers($limit = 24){
        $polyCottonQuery = "SELECT product_ID, product_cat_ID, product_name, product_actual_price, product_discounted_price, product_img_1, product_img_2, slug FROM products WHERE status = 'active' AND product_cat_ID = 2 ORDER BY product_ID DESC LIMIT $limit";

        $data = [];

        try {
            $result = $this->conn->query($polyCottonQuery);

            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
                return $data;
            }
        } catch (Exception | Error $e) {
            echo "<script>console.log('Error in polyCottonTrousers: " . $e->getMessage() . "')</script>";
            return null;
        }
    }    

    public function getSingleProduct(){
        $product_ID = isset($_GET['id']) ? $_GET['id'] : 1;

        if(is_numeric($product_ID)){
            $fetchSingleProduct = "SELECT * FROM products WHERE product_ID = $product_ID";

            try{
                $result = $this->conn->query($fetchSingleProduct);
                if($result->num_rows == 0){
                    // Select default product when no product found for the given ID:
                    $fetchDefaultProduct = "SELECT * FROM products WHERE product_ID = $product_ID";
                    $defaultResult = $this->conn->query($fetchDefaultProduct);
                    $defaultProduct = $defaultResult->fetch_assoc();
                    return $defaultProduct;      
                }

                $data = $result->fetch_assoc();
                return $data;

            } catch(Exception | Error $e){
                echo "<script>console.log('Error in getSingleProduct: " . $e->getMessage() . "')</script>";
                return null;
            }
          
        } else{
            // Select default product when there is no ID parameter or ID is non numeric:
                $fetchDefaultProduct = "SELECT * FROM products WHERE product_ID = 1";
                $defaultResult = $this->conn->query($fetchDefaultProduct);
                $defaultProduct = $defaultResult->fetch_assoc();
                return $defaultProduct;
        }

    }

}
