<?php

    $host = "localhost";
    $dbname = "shop_app";
    $username = "root";
    $password = "root";
    $conn = new PDO("mysql:host=$host;dbname=$dbname",$username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $prod_id = $_POST['prod_id'];
    // Delete the associated order_items first
    $delete_order_items_sql = "DELETE FROM order_items WHERE product_id = :id";
    $delete_order_items_stmt = $conn->prepare($delete_order_items_sql);
    $delete_order_items_stmt->bindParam(":id", $prod_id);
    $delete_order_items_stmt->execute();

   
    $sql = "DELETE FROM products WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id",$prod_id);
    $stmt->execute();

   header("Location: index.php");

?>