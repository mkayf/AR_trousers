<?php

class OrdersController{
    public $conn;

    public function __construct($db_connection)
    {
        $this->conn = $db_connection;
    }

    public function getUserOrders($user_ID){
        $user_orders = "SELECT * FROM orders WHERE user_ID = $user_ID ORDER BY order_ID DESC";

        $orders_result = $this->conn->query($user_orders);

        if($orders_result){
            $orders = [];

            while($row = $orders_result->fetch_assoc()){
                $orders[] = $row;
            }

            return $orders;
        }

        return null;
    }

    public function getOrderItems($order_ID){
        $get_order_items = "SELECT oi.product_ID, oi.quantity, oi.subtotal, oi.size, oi.color, p.product_img_1, p.product_name, IF(p.product_discounted_price IS NOT NULL, p.product_discounted_price, p.product_actual_price) AS price
        FROM order_items AS oi
        INNER JOIN products AS p
        ON oi.product_ID = p.product_ID
        WHERE oi.order_ID = $order_ID";

        $order_items_result = $this->conn->query($get_order_items);

        if($order_items_result){
            $order_items = [];
            while($row = $order_items_result->fetch_assoc()){
                $order_items[] = $row;
            }
            return $order_items;  
        }

        return null;
    }

    public function getShippingDetails($order_ID){
        $get_shipping_query = "SELECT * FROM saved_shipping_details WHERE order_ID = $order_ID";

        $shipping_result = $this->conn->query($get_shipping_query);

        if($shipping_result){
            $shipping_details = $shipping_result->fetch_assoc();
            return $shipping_details;
        }

        return null;
    }

    public function cancelOrder($order_ID){
        $cancel_query = "UPDATE orders SET order_status = 'Canceled' WHERE order_ID = $order_ID";

        $cancel_result = $this->conn->query($cancel_query);

        if($cancel_result){
            if($this->conn->affected_rows > 0){
                return true;
            } 
            else {
                return false;
            }
        }
    }

}

?>