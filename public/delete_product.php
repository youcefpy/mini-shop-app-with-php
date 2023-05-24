<?php

    $host = "localhost";
    $dbname = "shop_app";
    $username = "root";
    $password = "root";
    $conn = new PDO("mysql:host=$host;dbname=$dbname",$username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $prod_id = $_POST['prod_id'];
    $sql = "DELETE FROM products WHERE id = :id";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id",$prod_id);
    $stmt->execute();

   header("Location: index.php");

?>