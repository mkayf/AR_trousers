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

}

?>