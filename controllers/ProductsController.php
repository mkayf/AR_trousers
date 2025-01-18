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
        if (isset($_GET['product-category']) && $_GET['product-category'] == 'Polyester_cotton') {
            return $this->polyCottonTrousers();
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
            echo "<script>console.log('Error in getProductsOnFirstLoad: " . $e->getMessage() . ", Line number: " . $e->getLine() . "')</script>";
            return null;
        }
    }


    public function newArrivalProducts($limit = 8)
    {
        $newArrivalProductsQuery = "SELECT product_ID, product_cat_ID, product_name, product_actual_price, product_discounted_price, product_img_1, product_img_2, slug FROM products WHERE status = 'active' ORDER BY product_ID DESC LIMIT $limit";

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
            echo "<script>console.log('Error in newArrivalProducts: " . $e->getMessage() . ", Line number: " . $e->getLine() . "')</script>";
            return null;
        }
    }

    public function polyCottonTrousers($limit = 24)
    {
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
            echo "<script>console.log('Error in polyCottonTrousers: " . $e->getMessage() . ", Line number: " . $e->getLine() . "')</script>";
            return null;
        }
    }

    public function getSingleProduct()
    {
        $product_ID = isset($_GET['id']) ? $_GET['id'] : 1;

        if (!is_numeric($product_ID)) {
            // If product ID is non numeric then set to 1:
            $product_ID = 1;
        }

        $fetchSingleProduct = "SELECT p.product_ID, p.product_name, p.product_desc, p.product_actual_price, p.product_discounted_price, p.product_img_1, p.product_img_2, p.product_img_3, p.slug, cat.cat_name FROM products AS p
        INNER JOIN product_categories as cat
        ON p.product_cat_ID = cat.cat_ID           
        WHERE p.product_ID = $product_ID AND p.status = 'active';";

        $fetchSingleProduct .= "select c.color, si.size, s.stock_quantity
            from product_stock as s
            inner join product_colors as c
            on s.color_ID = c.color_ID
            inner join product_sizes as si
            on s.size_ID = si.size_ID
            where s.product_ID = $product_ID and c.color = 'black' and s.stock_quantity > 0";

        try {
            // Execute multi query:
            $this->conn->multi_query($fetchSingleProduct);

            // Fetch the first result of (product details):
            $product_result = $this->conn->store_result();


        if ($product_result->num_rows == 0) {

            // Clear any remaining results from initial query if no product returned for the given ID:

            while ($this->conn->more_results() && $this->conn->next_result()) {
                $unused_result = $this->conn->store_result();
                if ($unused_result) {
                    $unused_result->free();
                }
            }

            // Fetch default product details

            $fetchSingleProduct = "SELECT p.product_ID, p.product_name, p.product_desc, p.product_actual_price, p.product_discounted_price, p.product_img_1, p.product_img_2, p.product_img_3, p.slug, cat.cat_name FROM products AS p
            INNER JOIN product_categories as cat
            ON p.product_cat_ID = cat.cat_ID           
            WHERE p.product_ID = 1; AND p.status = 'active'";

            $fetchSingleProduct .= "select c.color, si.size, s.stock_quantity
            from product_stock as s
            inner join product_colors as c
            on s.color_ID = c.color_ID
            inner join product_sizes as si
            on s.size_ID = si.size_ID
            where s.product_ID = 1 and c.color = 'black' and stock_quantity > 0";

            $this->conn->multi_query($fetchSingleProduct);

            $product_result = $this->conn->store_result();
            $defaultData = $product_result->fetch_assoc();

            $this->conn->next_result();

            $stock_result = $this->conn->store_result();
            $stock_data = [];

            while ($row = $stock_result->fetch_assoc()) {
                $stock_data[] = $row;
            }

            if ($defaultData) {
                $defaultData['stock'] = $stock_data;
            }

            return $defaultData;

        }

            $data = $product_result->fetch_assoc();

            $this->conn->next_result();

            $stock_result = $this->conn->store_result();

        // Check if stock for black color is available or not:
            
        if($stock_result->num_rows == 0){

            $fetchWhiteStock = "select c.color, si.size, s.stock_quantity
            from product_stock as s
            inner join product_colors as c
            on s.color_ID = c.color_ID
            inner join product_sizes as si
            on s.size_ID = si.size_ID
            where s.product_ID = $product_ID and c.color = 'white' and s.stock_quantity > 0";

            $this->conn->multi_query($fetchWhiteStock);

            $stock_result = $this->conn->store_result();

        }

            $stock_data = [];

            while ($row = $stock_result->fetch_assoc()) {
                $stock_data[] = $row;
            }

            if ($data) {
                $data['stock'] = $stock_data;
            }

            return $data;
        } catch (Exception | Error $e) {
            echo "<script>console.log('Error in getSingleProduct: " . $e->getMessage() . ", Line number: " . $e->getLine() . "')</script>";
            return null;
        }
    }
}
