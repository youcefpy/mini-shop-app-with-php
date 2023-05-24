<?php 

    try{
        $host = "localhost";
        $dbname = "shop_app";
        $username = "root";
        $password = "root";
        $conn = new PDO("mysql:host=$host;dbname=$dbname",$username,$password);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        
        $prod_id = $_POST['prod_id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price= $_POST['price'];
        $stock_quantity  = $_POST['stock_quantity'];
        
        if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'images/uploaded/';
            $filename = $_FILES['image']['name'];
            $tempPath = $_FILES['image']['tmp_name'];

            // Move the uploaded file to the desired directory
            $imagePath = $uploadDir . $filename;
            move_uploaded_file($tempPath, $imagePath);
        }

        $sql = "update products SET  name = :name, description = :description, price = :price, stock_quantity = :quantity, image_prod = :image_path where id = :prod_id";
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':name',$name);
        $stmt->bindParam(':description',$description);
        $stmt->bindParam(':price',$price);
        $stmt->bindParam(':quantity',$stock_quantity);
        $stmt->bindParam(':image_path',$imagePath);
        $stmt->bindParam(':prod_id',$prod_id);
        $stmt->execute();

        header("Location: table_products.php");

        }catch(PDOException $e){
            echo $e->getMessage();
        }

?>