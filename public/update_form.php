<?php

    try{


        $host = "localhost";
        $dbname = "shop_app";
        $username = "root";
        $password = "root";
        $conn = new PDO("mysql:host=$host;dbname=$dbname",$username,$password);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);


        $sql = "SELECT * FROM products";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    catch(PDOException $e){
        echo $e->getMessage();    
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link rel="icon" href="data:,">

    <title>Update Products</title>
</head>
<body>
    <div class="container mt-5 mb-5">
        <div class="title-add-product">
            <h2 class="h2"> Update Products</h2>
        </div>
    </div>
    <div class="container">
        <form action="update_product.php" method="POST" enctype="multipart/form-data">
            
            <div class="mb-3 mt-3">
                <input type="hidden" class="form-control" id="prod_id" name="prod_id" value="<?php echo $product['id'] ?>" />
            </div>
            
            <div class="mb-3 mt-3">
                <label for="name" class="form-label">Name :</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $product['name']  ?>" />
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">description :</label>
                <input type="text" class="form-control" id="description" name="description" value="<?php echo $product['description'] ?>" />
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price :</label>
                <input type="text" class="form-control" id="price" name="price" value="<?php echo $product['price']  ?>" />
            </div>
            <div class="mb-3">
                <label for="stock_quantity" class="form-label">Quantity in the stock :</label>
                <input type="number" class="form-control" id="stock_quantity"  name="stock_quantity" value="<?php echo $product['stock_quantity']  ?>" />
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image of the Product:</label>
                <input type="file" class="form-control" id="image" name="image" value="<?php echo $product['image_prod'] ?>" />
            </div>
                <button type="submit" class="btn btn-primary">Update Product</button>
        
        </form> 
    </div>
