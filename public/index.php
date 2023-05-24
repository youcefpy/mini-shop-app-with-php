<?php
    session_start();

    $host = "localhost";
    $dbname = "shop_app";
    $username = "root";
    $password = "root";
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $isLoggedIn = isset($_SESSION['id']); // Check if the 'id' session variable is set

    if ($isLoggedIn) {
        $cust_id = $_SESSION['id'];
        $query = "SELECT first_name FROM customers WHERE id = :cust_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":cust_id", $cust_id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $customerName = $row['first_name'];
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/style/style.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <link rel="icon" href="data:,">
    <link rel="stylesheet" href="/assets/style/header.css">
    <link rel="stylesheet" href="/assets/style/style.css">
    <title>Boutique Shop</title>
</head>
<body>
    <div class="container">
        <div class="header">
            <?php
                if ($isLoggedIn) {
                    include "header_logged_in.php"; 
                    ?>
                    <a href="cart.php" class="cart_link">
                        <img src = "assets/icons/purchase.png" class="cart_icon">
                    </a>
                <?php    
                } else {
                    include "header.php"; 
                }
            ?>
            

        </div>
        <!-- <div class="container">
            <a href="add_products.php" class="btn btn-success">Add Products</a>
        </div> -->
        <div class="row">
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

                    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach($products as $product ){
                        $name = $product['name'];
                        $price = $product["price"];
                        $description = $product['description'];
                        $imagePath = $product['image_prod'];
                        $product_id = $product['id'];
                        echo '
                            <div class="col-md-4">
                                <div class="card mt-3 mb-3">
                                    <img src="' . $imagePath . '" class="card-img-top" alt="' . $name . '" width = "300px" height="300px">
                                    <div class="card-body">
                                        <h5 class="card-title">' . $name . '</h5>
                                        <p class="card-text">' . $description . ' </p> 
                                        <div class="price-purchase-div">
                                            <p class="card-text price-txt">' . $price . ' DA</p>
                                            <a href="add_to_cart.php?product_id='. $product_id .'">
                                                <img src = "assets/icons/purchase.png" class="img-pusrchase">
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        
                        
                        ';
                    }
                }
                
                catch(ErrorException $e){
                    echo $e->getMessage();
                }
                

            
            
            ?>
        </div>
        
    </div>
</body>
</html>