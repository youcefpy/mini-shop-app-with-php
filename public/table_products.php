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
    <title>Table Products for Editing and deleting</title>
</head>
<body>
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
        ?>
        
       
           
                <div class="container">
                    <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">DELETE</th>
                        <th scope="col">EDIT</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <?php foreach($products as $product){ ?>
                            <td><?php echo $product['name']  ?> </td> 
                            <td><?php echo $product['description']  ?> </td> 
                            <td><?php echo $product['price']  ?> </td> 
                            <td><?php echo $product['stock_quantity']  ?> </td> 
                            <td>
                                <form action="delete_product.php" method="POST">
                                    <input type="hidden"  name="prod_id" value="<?php echo $product['id']; ?>">
                                    <button class="btn btn-danger"> DELETE </button>
                                </form>
                            </td>
                                
                            <td>
                                <a href="update_form.php" class="btn btn-primary"> EDIT </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    </table>
                </div>

            <?php } catch(ErrorException $e){
                    echo $e->getMessage();
                 }
            ?>
</body>
</html>