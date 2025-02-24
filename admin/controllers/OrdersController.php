<?php

class OrdersController {
    public $conn;

    public function __construct($db_connection)
    {
        $this->conn = $db_connection;
    }

    public function getOrders(){
        
        $orders = [];
        // get only orders from orders table:

        $getOrdersQuery = "SELECT * FROM orders";

        $orderResult = $this->conn->query($getOrdersQuery);
        
        if($orderResult){
            while($row = $orderResult->fetch_assoc()){
                $orders[] = $row;
            }
            return $orders;
        }

        return null;
    }

    public function getOrderItems($order_ID){
        
        $order_items_query = "SELECT oi.product_ID, oi.quantity, oi.subtotal, oi.size, oi.color, p.product_img_1, p.product_name, IF(p.product_discounted_price IS NOT NULL, p.product_discounted_price, p.product_actual_price) AS price
        FROM order_items AS oi
        INNER JOIN products AS p
        ON oi.product_ID = p.product_ID
        WHERE oi.order_ID = $order_ID";

        $order_item_result = $this->conn->query($order_items_query);

        if($order_item_result){
            $order_items = [];
            while($row = $order_item_result->fetch_assoc()){
                $order_items[] = $row; 
            }
            return $order_items;
        }

        return null;

    }

    public function getShippingDetails($shipping_ID){

        $get_shipping_query = "SELECT * FROM shipping_details WHERE shipping_ID = $shipping_ID";

        $shipping_result = $this->conn->query($get_shipping_query);

        if($shipping_result){
            $shipping_details = $shipping_result->fetch_assoc();
            return $shipping_details;
        }

        return null;
    }

    public function updateOrderStatus($order_ID, $status){
        $update_order_status = "UPDATE orders SET order_status = '$status' WHERE order_ID = $order_ID";

        $status_result = $this->conn->query($update_order_status);

        if($status_result){

            // If order status is cancelled then transfer the order items stock to product stock table:

            if($status == 'Canceled'){
                // Fetch the order items first:
                $order_items_query = "SELECT product_ID, quantity, size, color FROM order_items WHERE order_ID = $order_ID";

                $order_items_result = $this->conn->query($order_items_query);
                if($order_items_result){
                    while($row = $order_items_result->fetch_assoc()){
                        // Update the product stock table for each size and color:
                        $update_product_stock = "UPDATE product_stock SET stock_quantity = stock_quantity + $row[quantity] WHERE product_ID = '$row[product_ID]' AND color_ID = (SELECT color_ID FROM product_colors WHERE color = '$row[color]')
                        AND size_ID = (SELECT size_ID FROM product_sizes WHERE size = '$row[size]')";

                        $update_result = $this->conn->query($update_product_stock);

                        if(!$update_result){
                            return false;
                        }

                    }
                } else{
                    return false;
                }
            }

            return true;
        } else{
            return false;
        }
    }

    public function updatePaymentStatus($order_ID, $status){
        $update_payment_status = "UPDATE orders SET payment_status = '$status' WHERE order_ID = $order_ID";

        $status_result = $this->conn->query($update_payment_status);

        if($status_result){
            return true;
        } else{
            return false;   
        }
    }

}

?>