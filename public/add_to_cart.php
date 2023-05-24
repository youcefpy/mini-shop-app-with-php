<?php
session_start();
try {
    $host = "localhost";
    $dbname = "shop_app";
    $username = "root";
    $password = "root";
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    $product_id = $_GET["product_id"];

    // Check if the product is already in the cart for the current customer
    $customer_id = $_SESSION['id'];
    $query_check = "SELECT * FROM order_items WHERE product_id = :product_id AND customer_id = :customer_id";
    $stmt = $conn->prepare($query_check);
    $stmt->bindParam(":product_id", $product_id);
    $stmt->bindParam(":customer_id", $customer_id);
    $stmt->execute();
    $existing_order_item = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existing_order_item) {
        // If the product is already in the cart, update the quantity and price
        $query_update = "UPDATE order_items SET quantity = quantity + 1, price = price * (quantity) WHERE product_id = :product_id AND customer_id = :customer_id";
        $stmt = $conn->prepare($query_update);
        $stmt->bindParam(":product_id", $product_id);
        $stmt->bindParam(":customer_id", $customer_id);
        $stmt->execute();
    } else {
        // If the product is not in the cart, add it with quantity 1
        $query = "SELECT * FROM products WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":id", $product_id);
        $stmt->execute();
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($product && $product['stock_quantity'] > 0) {
            // Insert the order item into the order_items table
            $query_insert = "INSERT INTO order_items (customer_id, product_id, quantity, price) VALUES (:customer_id, :product_id, :quantity, :price)";
            $stmt = $conn->prepare($query_insert);
            $stmt->bindParam(":customer_id", $customer_id);
            $stmt->bindParam(":product_id", $product_id);
            $stmt->bindValue(":quantity", 1); // Assuming the quantity is always 1
            $stmt->bindParam(":price", $product['price']);
            $stmt->execute();

            // Update the stock quantity of the product
            $query_update_quantity = "UPDATE products SET stock_quantity = stock_quantity - 1 WHERE id = :id";
            $stmt = $conn->prepare($query_update_quantity);
            $stmt->bindParam(":id", $product_id);
            $stmt->execute();
        }
    }

    header("Location: index.php");
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>
