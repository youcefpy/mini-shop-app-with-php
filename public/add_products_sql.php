<?php 
$host = "localhost";
$dbname = "shop_app";
$username = "root";
$password = "root";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname",$username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);


    
    if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'images/uploaded/';
        $filename = $_FILES['image']['name'];
        $tempPath = $_FILES['image']['tmp_name'];

        // Move the uploaded file to the desired directory
        $imagePath = $uploadDir . $filename;
        move_uploaded_file($tempPath, $imagePath);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';
        $price = isset($_POST['price']) ? $_POST['price'] : '';
        $quantity = isset($_POST['stock_quantity']) ? $_POST['stock_quantity'] : '';

        if (empty($name) || empty($description) || empty($price) || empty($quantity)) {
            echo "Please fill in all the fields.";
            exit;
        }

        $sql = "INSERT INTO products (name, description, price, stock_quantity,image_prod) VALUES (:name, :description, :price, :stock_quantity, :image_prod)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":stock_quantity", $quantity);
        $stmt->bindParam(":image_prod",$imagePath);

        $stmt->execute();
        header("Location: index.php");
        exit();
    }
    } catch(PDOException $e) {
        echo "CONNECTION FAILED: " . $e->getMessage();
    }
?>