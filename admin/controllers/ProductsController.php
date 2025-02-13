<?php
class ProductsController
{
    public $conn;

    public function __construct($db_connection)
    {
        $this->conn = $db_connection;
    }

    // Add product functionality where all the details related to product is added: 

    public function addProduct($product_data)
    {

        $category_ID = $product_data['category'];
        $product_adding_errors = [];
        $img_paths = [];

        // Check for empty fields:
        if (!empty($product_data['name']) && !empty($product_data['category']) && !empty($product_data['images']['name'][0]) && !empty($product_data['desc']) && !empty($product_data['price'])) {

            // Fetch product category first to set the directory path for image uploads:
            $fetch_cat = "SELECT cat_name from product_categories WHERE cat_ID = $category_ID";
            $result = $this->conn->query($fetch_cat);
            $category_name = $result->fetch_assoc();


            // Check if only three or less than 3 product images are being uploaded:
            if (count($product_data['images']['name']) <= 3 && count($product_data['images']['name']) != 0) {

                // Loop through images to insert one by one in the upload directory:
                for ($i = 0; $i < count($product_data['images']['name']); $i++) {
                    $image_name = basename($product_data['images']['name'][$i]);

                    $target_file_path = '/assets/product_images/' . $category_name['cat_name'] . '/' . $image_name;

                    $upload_dir = __DIR__ . '/../..';


                    // Check if the uploaded files are actual images:
                    $file_type = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
                    $accepted_extensions = ['avif', 'webp', 'jpg', '.jpeg', 'png', 'jfif'];

                    if (in_array($file_type, $accepted_extensions)) {

                        // Move images to uploads directory:
                        if (move_uploaded_file($product_data['images']['tmp_name'][$i], $upload_dir . $target_file_path)) {

                            $img_paths[] = mysqli_real_escape_string($this->conn, $target_file_path);

                        } else {
                            $product_adding_errors['image_error'] = 'Failed to upload image: ' . $image_name;
                        }
                    } else {
                        $product_adding_errors['extension_error'] = 'You can only upload images of these extensions: AVIF, WEBP, PNG, JPG, JPEG';
                    }
                }
            } else {
                $product_adding_errors['image_limit_error']  =  'Only three or less than three images are allowed.';
            }
        
        } else {
            $product_adding_errors['empty_fields'] = 'Please fill all the required product details';
        }


        // Inserting product data into database:

        $product_img_1 = $img_paths[0] ?? null;
        $product_img_2 = $img_paths[1] ?? null;
        $product_img_3 = $img_paths[2] ?? null;


        $insertProductDetails = "INSERT INTO products(product_cat_ID, product_name, product_desc, product_actual_price, product_discounted_price, product_img_1, product_img_2, product_img_3, status, slug) VALUES($category_ID, '$product_data[name]', '$product_data[desc]', $product_data[price], $product_data[discounted_price], '$product_img_1', '$product_img_2', '$product_img_3', '$product_data[status]', '$product_data[slug]')";

        if(empty($product_adding_errors)){
            $product_data_result = $this->conn->query($insertProductDetails);

            if (!$product_data_result) {
                $product_adding_errors['product_details_insertion'] = 'Failed to insert product details into database. Please try again';
            }
    
        }



        // Get the last inserted product ID to insert into product stock table:

        $last_product_ID = $this->conn->insert_id;

        // Looping through queries to insert multiple records at the same time

        $insert_product_stock = "";

        $colors = [
            'black' => $product_data['colors']['black']['black_color_ID'],
            'white' => $product_data['colors']['white']['white_color_ID']
        ];

        foreach ($colors as $color => $color_ID) {
            $size_keys = array_keys($product_data['colors'][$color]['sizes']);
            for ($i = 0; $i < 5; $i++) {
                $insert_product_stock .= "
                INSERT INTO product_stock (product_ID, color_ID, size_ID, stock_quantity) VALUES ($last_product_ID, " . $color_ID . ", " . ($i + 1) . ", " . $product_data['colors'][$color]['sizes'][$size_keys[$i]] . ");
                ";  
            }
        }

        if(empty($product_adding_errors)){
            $product_stock_result = $this->conn->multi_query($insert_product_stock);

            if (!$product_stock_result) {
                $product_adding_errors['stock_error'] = 'Failed to insert stock against this product. Please try again';
            }
        }


        // Return true if no errors occur or return errors array:
        return empty($product_adding_errors) ? true : $product_adding_errors;

        
    }

    public function listProducts(){
        $listProductsQuery = "SELECT p.product_ID, p.product_name, p.product_actual_price, p.product_discounted_price, p.product_img_1, p.status, c.cat_name, SUM(s.stock_quantity) AS total_stock FROM products as p
        INNER JOIN product_categories as c
        ON p.product_cat_ID = c.cat_ID
        INNER JOIN product_stock as s
        ON p.product_ID = s.product_ID
        GROUP BY p.product_ID, p.product_name, p.product_actual_price, p.product_discounted_price, p.product_img_1, p.status, c.cat_name
        ORDER BY p.product_ID DESC";

        try{
            $result = $this->conn->query($listProductsQuery);
    
            if($result->num_rows > 0){
                $products = [];
                while($row = $result->fetch_assoc()){
                    $products[] = $row;
                }
                return $products;
            }
        }
        catch(Error | Exception $e){
            echo "<script>console.log('Error in listProducts: ". $e->getMessage() .", Line number: ". $e->getLine() ."');</script>";
            return null;   
        }
    }

    public function deleteProduct($product_ID){
        // Delete record from product_stock(child table) first:
        $delete_stock = "DELETE FROM product_stock WHERE product_ID = $product_ID";

        $stock_result = $this->conn->query($delete_stock);

        if($stock_result){
            $delete_product = "DELETE FROM products WHERE product_ID = $product_ID";

            $product_result = $this->conn->query($delete_product);
            if($product_result){
                return true;
            } else{
                return false;
            }
        } else{
            return false;
        }
    }

    public function getProductDetails($product_ID){
        $getProduct = "SELECT * FROM products as p
        INNER JOIN product_categories as c
        on p.product_cat_ID = c.cat_ID
        WHERE p.product_ID = $product_ID";

        $product_result = $this->conn->query($getProduct);

        if($product_result){

            $product_details = $this->conn->query();
        } else{
            return null;
        }

        $getStock = "select s.color_ID, c.color, s.size_ID, si.size, s.stock_quantity FROM product_stock as s
        inner join product_colors as c
        on s.color_ID = c.color_ID
        inner join product_sizes as si
        on s.size_ID = si.size_ID
        where s.product_ID = $product_ID";
        
    }

}
